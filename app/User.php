<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
    	'phone_number',
    	'name',
    	'profile_pic_url',
    	'jro_puri_id',
    	'member_type',
    ];

    protected $attributes = [
    	'profile_pic_url' => 'https://www.dummyimage.com/100',
    	'member_type' => 0,
    ];

    public function jro_puri() {
        return $this->belongsTo('App\JroPuri', 'jro_puri_id', 'id');
    }

    public function detail() {
        return $this->hasOne('App\UserDetail', 'user_id');
    }

    public function promo_used() {
        return $this->hasMany('App\PromoUsage');
    }
}
