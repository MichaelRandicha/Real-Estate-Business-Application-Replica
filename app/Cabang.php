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

    protected $appends = ['total_pendapatan'];

    public function getTotalPendapatanAttribute()
    {
        $pendapatan = 0;
        foreach ($this->member as $user) {
            $pendapatan = $pendapatan + $user->pendapatan;
        }
        return $pendapatan;
    }
}
