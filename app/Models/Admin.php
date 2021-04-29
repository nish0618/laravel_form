<?php

namespace App\Models;

use App\Models\LoginHistory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $hidden = ['password'];

    public function login_histories()
    {
        return $this->hasMany(LoginHistory::class);
    }
}
