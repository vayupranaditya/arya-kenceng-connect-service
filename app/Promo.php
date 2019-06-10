<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';

    protected $fillable = [
    	'name',
    	'description',
    	'image_url',
    ];

    protected $attributes = [
    	'image_url' => 'https://www.dummyimage.com/300x200',
    ];
}
