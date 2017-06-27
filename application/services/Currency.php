<?php

class Application_Service_Currency
{
    protected $currencyMapper;
    protected $cache;
    protected $from;
    protected $to;
    protected $valueEUR;
    protected $rates = array();

    protected $frontendOptions = array(
        'lifetime' => 3600,
        'automatic_serialization' => true
    );

    protected $backendOptions = array(
    'cache_dir' => './tmp/'
    );

    public function __construct()
    {
        $this->currencyMapper = new Application_Model_CurrencyMapper();
        $this->cache = Zend_Cache::factory('Core', 'File', $this->frontendOptions, $this->backendOptions);
    }

    public function calculate($value, $from, $to)
    {
        //get European Central Bank courses (exchange rate against euro)
        $this->loadRates();

        $this->from = $this->currencyMapper->find($from);
        $this->to = $this->currencyMapper->find($to);

        //convert to EUR
        if ($this->from->name != 'EUR') {
            foreach ($this->rates as $rate) {
                if ($rate['currency'] == $this->from->name) {
                    $this->valueEUR = $value / (float)$rate['rate'];
                }
            }
        } else {
            $this->valueEUR = $value;
        }

        //convert to selected currency
        if ($this->to->name != 'EUR') {
            foreach ($this->rates as $rate) {
                if ($rate['currency'] == $this->to->name) {
                    return $this->valueEUR * (float)$rate['rate'];
                }
            }
        } else {
            return $this->valueEUR;
        }
    }

    protected function loadRates()
    {
        if (!$rates = $this->cache->load('rates')) { // From cache
            $xml = simplexml_load_string(file_get_contents('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml'));
            foreach ($xml->Cube->Cube->Cube as $rate) {
                $this->rates[] = ((array)$rate)['@attributes'];
            }
            $this->cache->save($this->rates, 'rates');
        } else {
            $this->rates = $rates;
        }
    }
}