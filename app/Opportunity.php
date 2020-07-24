<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class opportunity extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function application(){
        return $this->hasMany(Application::class);
    }
}
