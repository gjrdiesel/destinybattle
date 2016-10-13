<?php

namespace App\Http\Controllers;

use App\Destiny\Manifest\Update;
use App\Destiny\Player;

class ApiController extends Controller
{
    public function searchPlayer(Player $api, $console, $name)
    {
//        return $api->SearchPlayer($console,$name);
        $manifest = new Update();
        $manifest->cache();
    }
}
