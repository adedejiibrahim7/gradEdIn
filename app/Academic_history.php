<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class academic_history extends Model
{
    protected $guarded = [];

    public function profile(){
        return $this->belongsTo(profile::class);
    }
}
