<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements Transformable
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
        'updated_at'
    ];

    protected $table = 'users';

}
