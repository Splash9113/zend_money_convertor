<?php

use Phinx\Seed\AbstractSeed;

class CurrenciesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'name'    => 'EUR'
            ),
            array(
                'name'    => 'USD'
            ),
            array(
                'name'    => 'JPY'
            ),
            array(
                'name'    => 'BGN'
            ),
            array(
                'name'    => 'CZK'
            ),
            array(
                'name'    => 'DKK'
            ),
            array(
                'name'    => 'GBP'
            ),
            array(
                'name'    => 'HUF'
            ),
            array(
                'name'    => 'PLN'
            ),
            array(
                'name'    => 'RON'
            ),
            array(
                'name'    => 'SEK'
            ),
            array(
                'name'    => 'CHF'
            ),
            array(
                'name'    => 'NOK'
            ),
            array(
                'name'    => 'HRK'
            ),
            array(
                'name'    => 'RUB'
            ),
            array(
                'name'    => 'TRY'
            ),
            array(
                'name'    => 'AUD'
            ),
            array(
                'name'    => 'BRL'
            ),
            array(
                'name'    => 'CAD'
            ),
            array(
                'name'    => 'CNY'
            ),
            array(
                'name'    => 'HKD'
            ),
            array(
                'name'    => 'IDR'
            ),
            array(
                'name'    => 'ILS'
            ),
            array(
                'name'    => 'INR'
            ),
            array(
                'name'    => 'KRW'
            ),
            array(
                'name'    => 'MXN'
            ),
            array(
                'name'    => 'MYR'
            ),
            array(
                'name'    => 'NZD'
            ),
            array(
                'name'    => 'PHP'
            ),
            array(
                'name'    => 'SGD'
            ),
            array(
                'name'    => 'THB'
            ),
            array(
                'name'    => 'ZAR'
            )
        );

        $currencies = $this->table('currency');
        $currencies->insert($data)
            ->save();
    }
}
