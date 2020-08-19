<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    protected $guarded = [];
    public function User(){
        return $this->belongsTo(User::class);
    }
}
