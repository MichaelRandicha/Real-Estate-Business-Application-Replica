<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    protected $fillable = [
        'nama', 'harga', 'tanggal'
    ];

    public function closing() {
    	return $this->hasMany('App\AgentClosing');
    }

}
