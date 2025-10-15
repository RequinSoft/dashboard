<?php

if(!function_exists('getExchangeRates')) {
    /**
     * Fetch exchange rates from an external API.
     *
     * @param array $currencies List of currency codes to fetch rates for.
     * @param string $source The source currency code.
     * @return array The exchange rates data.
     */
    function getExchangeRates($currencies, $source) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$currencies."&from=".$source."&amount=1",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: E0GpUZknWn12mNBs7iwlUvPoZ2qJS8NO"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $exchangeRates = json_decode($response, true);
        return $exchangeRates;
    }
}

if(!function_exists('getDemandaConfig')) {
    /**
     * Fetch KW data from an external device.
     *
     * @return string The KW data.
     */
    function getDemandaConfig() {
        // Fetch IP and setPoint from the database
        // Assuming you have a model named SetPointDemanda
        // and it has fields 'ip' and 'setpoint'
        // You may need to adjust this part based on your actual database structure

        // Example using Eloquent ORM
    }
}