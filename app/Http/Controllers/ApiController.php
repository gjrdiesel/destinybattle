<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Bungie\Bungie;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function searchPlayer(Bungie $api, $console, $name)
    {
        return Cache::remember('player_w_characters_'.$console.$name, Carbon::now()->addMinutes(10), function()use($api,$console,$name){
            return $api->SearchPlayer($console,$name);
        });
    }
}