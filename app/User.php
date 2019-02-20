<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'Users';

    protected $fillable = [
    	'phone_number',
    	'name',
    	'profile_picture_url',
    	'jro_puri_id',
    	'member_type',
    ];

    protected $attributes = [
    	'jro_puri_id' => 'none',
    	'member_type' => 0,
    ];
}
