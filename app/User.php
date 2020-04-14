<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'password', 'role'
    ];

    public $primaryKey = 'user_id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service(){
        return $this->hasMany(Service::class);
    }

    public function role(){
        return $this0->belongsTo('Role');
    }
}
