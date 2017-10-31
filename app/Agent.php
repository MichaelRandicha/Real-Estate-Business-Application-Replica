<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'nama', 'lokasi', 'telepon', 'cabang_id' , 'upline_id'
    ];

    public function upline(){
    	return $this->belongsTo('App\Agent', 'upline_id');
    }

    public function downline(){
    	return $this->hasMany('App\Agent', 'upline_id');
    }

    public function cabang(){
    	return $this->belongsTo('App\Cabang');
    }

	protected $appends = ['is_principal', 'is_vice', 'is_employed'];

    protected $hidden = [
        'is_principal', 'is_vice', 'is_employed'
    ];

    public function getIsPrincipalAttribute()
    {
        if($this->cabang == null){
            return false;
        }

    	if($this->cabang->principal == null){
    		return false;
    	}
        
        return $this->cabang->principal->id == $this->id;
    }

    public function getIsViceAttribute()
    {
    	if($this->cabang == null){
            return false;
        }

        if($this->cabang->vice == null){
    		return false;
    	}

        return $this->cabang->vice->id == $this->id;
    }

    public function getIsEmployedAttribute()
    {
        return $this->status;
    }
}
