<?php

class Application_Service_Rates
{
    protected $rates;

    public function loadRates()
    {
        $xml = simplexml_load_string(file_get_contents('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml'));
        foreach ($xml->Cube->Cube->Cube as $rate) {
            $this->rates[] = ((array)$rate)['@attributes'];
        }
        return $this->rates;

    }
}