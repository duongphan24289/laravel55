<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'name',
        'email'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token'
    ];

    protected $primaryKey = 'id';

    protected $table = 'users';

}
