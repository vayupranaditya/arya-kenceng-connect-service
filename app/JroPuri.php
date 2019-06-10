<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JroPuri extends Model
{
    protected $table = 'jro_puri';

    protected $fillable = [
    	'name',
    ];

    public function members() {
    	return $this->hasMany('App\User');
    }
}
