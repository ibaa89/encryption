<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccountPassword extends Model
{
    protected $table = 'user_account_password';

    protected $fillable = [
        'user_id',
        'account',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}