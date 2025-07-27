<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use the Authenticatable class
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable // Extend the Authenticatable class
{
    use HasFactory;

    protected $fillable = ['name', 'email','no_hp', 'password', 'role'];

    // Define the role as an enum
    protected $casts = [
        'role' => Role::class,
    ];

    // Optionally, you can create helper methods for checking roles
    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    public function isUser(): bool
    {
        return $this->role === Role::User;
    }
}
