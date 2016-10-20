<?php

namespace App\Bungie;

use GuzzleHttp\Client;

class Bungie
{
    public $guzzle;
    public $membershipType = 1;
    public $destinyMembershipId = 0;   //

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function SearchPlayer($membershipType, $displayName)
    {
        $this->membershipType = $membershipType;
        $response = $this->findMembershipIdByName($displayName);

        $this->destinyMembershipId = $response['membershipId'];

        return $this->findCharacters();
    }

    public function AllTimePvPStats()
    {
        $url = "http://www.bungie.net/Platform/Destiny/Stats/Account/{$this->membershipType}/{$this->destinyMembershipId}/";

        $response = $this->guzzle->get($url,[
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['Response']['mergedAllCharacters']['results']['allPvP']['allTime'];
    }

    public function findMembershipIdByName($displayName)
    {
        $url = "http://www.bungie.net/Platform/Destiny/SearchDestinyPlayer/{$this->membershipType}/{$displayName}/";

        $response = $this->guzzle->get($url,[
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['Response'][0];
    }

    public function findCharacters()
    {
        $url = "http://www.bungie.net/Platform/Destiny/{$this->membershipType}/Account/{$this->destinyMembershipId}/Summary/";

        $response = $this->guzzle->get($url,[
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        /**
         * If you're debugging this; you'll need to go to http://destinybattle.dev/api/search/1/itz%20hydrogen%201
         *
         * Remember, it's cached so run: php artisan cache:clear
         *
         */
        //dd(json_decode($response->getBody()->getContents(), true));

        return [
            'display' => json_decode($response->getBody()->getContents(), true)['Response']['data'],
            'pvpstats' => $this->AllTimePvPStats()
        ];
    }
}