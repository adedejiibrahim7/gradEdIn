<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed is_admin
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'name',
        'email', 'password', 'user_type', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function profile(){
        return $this->hasOne(profile::class);
    }

    public function opportunities(){
        return $this->hasMany(opportunity::class);
    }
    public function Application(){
        return $this->hasMany(Application::class);
    }
    public function EmployerProfile(){
        return $this->hasOne(EmployerProfile::class);
    }

    public function Publication(){
        return $this->hasMany(Publication::class);
    }

    public function resource(){
        return $this->hasMany(Resource::class);
    }
}
