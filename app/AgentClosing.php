<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClosing extends Model
{
    protected $table = 'agent_closing';

    protected $fillable = [
        'agent_id', 'closing_id', 'komisi', 'upline1_id' , 'upline1_komisi',
        'upline2_id' , 'upline2_komisi', 'upline3_id' , 'upline3_komisi',
        'principal_id' , 'principal_komisi', 'vice_id' , 'vice_komisi'
    ];

    public function agent() {
    	return $this->belongsTo('App\Agent');
    }

    public function closing() {
    	return $this->belongsTo('App\Closing');
    }

    public function cabang() {
        return $this->belongsTo('App\Cabang');
    }

    public function upline1() {
    	return $this->belongsTo('App\Agent', 'upline1_id');
    }

    public function upline2() {
    	return $this->belongsTo('App\Agent', 'upline2_id');
    }

    public function upline3() {
    	return $this->belongsTo('App\Agent', 'upline3_id');
    }

    public function principal() {
    	return $this->belongsTo('App\Agent', 'principal_id');
    }

    public function vice() {
    	return $this->belongsTo('App\Agent', 'vice_id');
    }

}
