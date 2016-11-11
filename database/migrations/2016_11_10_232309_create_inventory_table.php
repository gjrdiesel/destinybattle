<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items',function(Blueprint $table) {

            $table->bigInteger('itemHash')->nullable();
            $table->string('itemName')->nullable();
            $table->longText('itemDescription')->nullable();
            $table->text('icon')->nullable();
            $table->text('tierTypeName')->nullable();
            $table->text('itemTypeName')->nullable();
            $table->bigInteger('bucketTypeHash')->nullable();
            $table->bigInteger('hash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory_items');
    }
}
