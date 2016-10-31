<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fight', function () {
    return view('fight');
});

//Route::get('/debug', function(){
//
//    $displayName = 'iTz HydrogeN 1';
//
//    $membershipType = 1; // xbox is 1, playstation is 2
//
//    // First we need to get a destiny membership id
//
////    $membershipIdLookup = app(\App\Bungie\Bungie::class)->findMembershipIdByName($displayName);
//
////    dd($membershipIdLookup);
//    /**
//     * MembershipId returns
//     * [
//        "iconPath" => "/img/theme/destiny/icons/icon_xbl.png"
//        "membershipType" => 1
//        "membershipId" => "4611686018431536316"
//        "displayName" => "iTz HydrogeN 1"
//       ]
//     */
//
//    // Now let's look up stats based on that destiny membership id
//    $destinyMembershipId = 4611686018431536316;
//
//    $statsLookup = app(\App\Bungie\Bungie::class)->stats($membershipType, $destinyMembershipId);
//
//    return dd($statsLookup);
//});


Route::get('/api/search/{console}/{name}', 'ApiController@searchPlayer');
Auth::routes();

Route::get('/home', 'HomeController@index');
