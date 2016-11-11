<?php

use App\InventoryItem;
use Illuminate\Support\Facades\Storage;
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
        Storage::put('mobileWorldContentPaths.content',
            fopen('https://www.bungie.net/common/destiny_content/sqlite/en/world_sql_content_ccd5c9f3cc77a1a3cce4280603deff92.content',
                'r'));
    }

    /**
     * @test
     */
    public function unzip_database()
    {
        if (! is_dir(storage_path('app/mobileWorldContentPaths'))) {
            mkdir(storage_path('app/mobileWorldContentPaths'));
        }

        $zip = new ZipArchive();
        $zip->open(storage_path('app/mobileWorldContentPaths.content'));
        $zip->extractTo(storage_path('app/mobileWorldContentPaths/'));
        $zip->close();

        @unlink(storage_path('app/mobileWorldContentPaths.content'));
    }

    /**
     * @test
     */
    public function break_into_rows()
    {
        // Open a command line process to the recently downloaded database file and dump the database and then filter with 'grep' to only get the 'insert' data
        $file = popen('sqlite3 ' . glob(storage_path('app/mobileWorldContentPaths/*'))[0] . ' .dump DestinyInventoryItemDefinition | grep \'^INSERT INTO\'','r');

        // Loop through the command line process line by line
        while (($buffer = fgets($file)) !== false) {

            // Setup a regex to grab everything between the two brackets like: { ..... }
            $regex = '/({.*)\'\);/';

            // Runs the regex against the current line and sets a '$matches' variable
            preg_match_all($regex, $buffer, $matches);

            // Grab the important part of the '$matches' variable, decode it into an array using json_decode (with 'true')
            // and then put into a laravel collection
            $json = collect(json_decode($matches[1][0],true));

            // Save the json to the database
            InventoryItem::create($json->toArray());
        }
    }
}