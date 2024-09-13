<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
    ];

    public function accountPasswords()
    {
        return $this->hasMany(UserAccountPassword::class, 'user_id');
    }
}