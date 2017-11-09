<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $fillable = [
        'nama', 'lokasi', 'telepon', 'principal_id' , 'vice_id'
    ];

    public function principal(){
    	return $this->belongsTo('App\Agent', 'principal_id');
    }

    public function vice(){
    	return $this->belongsTo('App\Agent', 'vice_id');
    }

    public function member(){
    	return $this->hasMany('App\Agent');
    }

    public function kantor(){
        return $this->belongsTo('App\Agent', 'kantor_id');
    }

    public function closing(){
        return $this->hasMany('App\AgentClosing', 'cabang_id');
    }
}
