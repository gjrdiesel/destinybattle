<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConnectToSqliteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */
    public function download_database()
    {
        Storage::put('mobileGearAssetDataBases.content', fopen('https://www.bungie.net/common/destiny_content/sqlite/asset/asset_sql_content_ad146dfaa4e56d3c2685aaa7e26c0a6c.content','r'));
    }

    /**
     * @test
     */
    public function unzip_database()
    {
        $command = "unzip " . storage_path('app/mobileGearAssetDataBases.content');
        system($command);
    }

    /**
     * @test
     */
    public function connect_to_db()
    {
        dd(DB::connection('mobileGearAssetDatabases')->table('DestinyInventoryItemDefinition')->first());
    }
}
