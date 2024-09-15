<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'email',
    ];
    
    public function tokens()
    {
        return $this->hasMany(Token::class, 'user_id');
    }

    public function accountPasswords()
    {
        return $this->hasMany(UserAccountPassword::class, 'user_id');
    }
}