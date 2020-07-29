<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $guarded = [];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function skills(){
        return $this->belongsToMany(skills::class);
    }
    public function academic_history(){
        return $this->hasMany(academic_history::class);
    }
    public function certifications(){
        return $this->hasMany(certification::class);
    }

    //Note
    public function application(){
        return $this->hasMany(application::class);
    }
}
