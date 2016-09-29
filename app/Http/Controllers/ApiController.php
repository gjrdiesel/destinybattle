<?php

namespace App\Http\Controllers;

use App\Bungie\Bungie;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    public function searchPlayer(Bungie $api, $console, $name)
    {
        return $api->SearchPlayer($console,$name);
    }
}
