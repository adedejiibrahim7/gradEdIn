<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skills extends Model
{
    protected $guarded = [];

    public function profile(){
        return $this->belongsToMany(profile::class);
    }
}
