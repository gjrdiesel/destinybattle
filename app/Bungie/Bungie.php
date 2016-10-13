<?php

namespace App\Bungie;

use GuzzleHttp\Client;

class Bungie
{
    private $guzzle;
    private $membershipType = 0;
    private $destinyMembershipId = 0;

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

    private function findMembershipIdByName($displayName)
    {
        $url = "http://www.bungie.net/Platform/Destiny/SearchDestinyPlayer/{$this->membershipType}/{$displayName}/";

        $response = $this->guzzle->get($url,[
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['Response'][0];
    }

    private function findCharacters()
    {
        $url = "http://www.bungie.net/Platform/Destiny/{$this->membershipType}/Account/{$this->destinyMembershipId}/Summary/";

        $response = $this->guzzle->get($url,[
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        //dd(json_decode($response->getBody()->getContents(), true));

        return json_decode($response->getBody()->getContents(), true)['Response']['data'];
    }
}