<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'upc',
        'type',
        'category',
        'product',
        'description',
        'msrp',
        'wholesale',
        'private'
        ];
}