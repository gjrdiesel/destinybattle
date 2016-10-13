<?php

namespace App\Destiny;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Endpoint
{

    public static $PLAYER_SEARCH = 'SearchDestinyPlayer';
    public static $PLAYER_SUMMARY = 'AccountSummary';
    public static $MANIFEST = 'Manifest';

    public static function get($requestedEndpoint, $class)
    {
        $endpoints = [
            self::$PLAYER_SEARCH  => "SearchDestinyPlayer/{$class->membershipType}/{$class->displayName}/",
            self::$PLAYER_SUMMARY => "{$class->membershipType}/Account/{$class->destinyMembershipId}/Summary/",
            self::$MANIFEST       => "Manifest",
        ];

        return $endpoints[$requestedEndpoint];
    }
}

class Api
{

    private $apiCacheKey = null;
    private $futureDate = null;
    private $endpoint;
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public static function cache($class = null) : Api
    {
        if( is_null( $class ) ){
            $class = new Base();
        }

        return new self($class);
    }

    public function until(Carbon $futureDate) : Api
    {
        $this->futureDate = $futureDate;
        return $this;
    }

    private function addDefaultCacheDate()
    {
        $this->futureDate = Carbon::now()->addHour();
    }

    public function return (&$result)
    {
        $endpoint = $this->endpoint;

        if (is_null($this->futureDate)) {
            $this->addDefaultCacheDate();
        }

        $result = Cache::remember($this->apiCacheKey, $this->futureDate, function () use ($endpoint) {
            return self::call($endpoint);
        });
    }

    public static function call($endpoint) : array
    {
        $guzzle = new Client();

        $response = $guzzle->get("http://www.bungie.net/Platform/Destiny/" . $endpoint, [
            'headers' => [
                'X-API-Key' => env('BUNGIE_API')
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        if ($result['ErrorStatus'] !== 'Success') {
            throw new \Exception("{$result['Message']}: " . json_encode($result['MessageData']));
        }

        return $result;
    }

    public function endpoint($requestedEndpoint) : Api
    {
        $this->endpoint = Endpoint::get($requestedEndpoint, $this->class);

        $this->apiCacheKey = 'api_' . base64_encode($this->endpoint);

        return $this;
    }
}