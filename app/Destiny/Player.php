<?php

namespace App\Destiny;

use Carbon\Carbon;

/**
 *
 *  Example url for content:
 *  https://www.bungie.net/common/destiny_content/icons/95750a10c39c30fae62c96bd4b29ea45.jpg
 *
 * Class Destiny
 * @package App\Destiny
 */
class Player extends Base
{

    public $characters = [];
    public $grimoire = 0;

    /**
     * Public endpoint for the vuejs app
     * @param $membershipType
     * @param $displayName
     * @return Player
     * @throws \Exception
     */
    public function SearchPlayer($membershipType, $displayName) : Player
    {
        $this->membershipType = $membershipType;
        $this->displayName = $displayName;

        $this->findMembershipIdFromName()
            ->withCharacters();

        return $this;
    }

    /**
     * Grab character data
     * @return Player
     * @throws \Exception
     */
    private function withCharacters() : Player
    {
        $result = [];

        Api::cache($this)
            ->endpoint(Endpoint::$PLAYER_SUMMARY)
            ->return($result);

        $this->characters = $result['Response']['data']['characters'];
        $this->grimoire = $result['Response']['data']['grimoireScore'];

        return $this;
    }

    /**
     * First things first, find the membershipId from a gamer tag/display name
     * @return Player
     * @throws \Exception
     */
    private function findMembershipIdFromName() : Player
    {
        $result = [];

        Api::cache($this)
            ->endpoint(Endpoint::$PLAYER_SEARCH)
            ->until(Carbon::now()->addYear())
            ->return($result);

        $this->destinyMembershipId = $result['Response'][0]['membershipId'];
        $this->displayName = $result['Response'][0]['displayName'];

        return $this;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}