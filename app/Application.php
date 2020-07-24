<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function opportunity(){
        return $this->belongsTo(opportunity::class);
    }
}
