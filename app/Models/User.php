<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function documents()
    {
        return $this->hasMany(userDocument::class, 'user_id');
    }

  
  
}
