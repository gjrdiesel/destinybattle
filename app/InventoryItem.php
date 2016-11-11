<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = ['itemHash','itemName','itemDescription','icon','tierTypeName','itemTypeName','bucketTypeHash','hash'];
}
