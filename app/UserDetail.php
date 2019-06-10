<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
	protected $table = 'users_detail';

    protected $fillable = [
        'user_id',
        'birthdate',
        'is_male',
        'is_married',
        'current_address',
        'job',
        'business',
    ];

    public function summary() {
        return $this->belongsTo('App\User');
    }
}
