<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoUsage extends Model
{
    protected $table = 'promo_usage_log';

    protected $fillable = [
    	'user_id',
    	'promo_id',
    	'status',
    ];

    protected $attributes = [
    	'status' => 1,
    ];

    public function owner() {
    	return $this->hasOne('App\User');
    }
}
