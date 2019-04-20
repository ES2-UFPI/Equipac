<?php

namespace equipac\models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Bolsista extends Authenticatable
{
    protected $table = 'bolsista';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'password','cpf'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
