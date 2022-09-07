<?php

use GuzzleHttp\Client;

class Address
{
    const apiUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json';
    static function getAddress($postcode)
    {
        if ($postcode) {
            $response = Http::get('https://api.postcodes.io/postcodes/' . $postcode);
        } else {
            $address = [];
        }
        return self::fixAddddress($address);
    }

    private function fixAddddress($address)
    {
        return $address;
    }
    static function calculate($origins, $destinations): int
    {
        try {
            $key = env('GOOGLE_MAPS_DISTANCE_API_KEY');
            if(empty($key)){
                return -2;
            }
            $client = new Client(['verify' => false]);
            $response = $client->get(self::apiUrl, [
                'query' => [
                    'units'        => 'imperial',
                    'origins'      => $origins,
                    'destinations' => $destinations,
                    'key'          => $key,
                    'random'       => random_int(1, 100),
                ],
            ]);
            $statusCode = $response->getStatusCode();
            if (200 === $statusCode) {
                $responseData = json_decode($response->getBody()->getContents());
                if (isset($responseData->rows[0]->elements[0]->distance)) {
                    return $responseData->rows[0]->elements[0]->distance->value/1000;
                }
            }
            return -1;
        } catch (Exception $e) {
            return -1;
        }
    }

}
