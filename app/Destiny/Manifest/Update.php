<?php

namespace App\Destiny\Manifest;

use App\Destiny\Api;
use App\Destiny\Endpoint;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class Update {

    public function cache()
    {
        $result = [];
        Api::cache()
            ->endpoint(Endpoint::$MANIFEST)
            ->return($result);

        // Check $result response version number, if changed, then update each database

        $path = $result['Response']['mobileWorldContentPaths']['en'];

        Storage::put(basename($path), fopen('http://bungie.net/' . $path,'r') );
    }
    
}