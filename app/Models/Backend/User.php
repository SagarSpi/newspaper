<?php

namespace App\Models\Backend;

use App\Models\Frontend\Comment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    public function comments()
    {
        return $this->morphToMany(Comment::class,'commentable');
    }
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'contacts',
        'image_url',
        'image_id',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function Contacts() : Attribute {
        return Attribute::make(
            get: fn(?string $value) => $value ? '0' . ltrim($value, '0') : null
        );
    }
    protected function Status() : Attribute {
        return Attribute::make(
            get:fn(string $value)=>ucwords($value)
        );
    }
    protected function Role() : Attribute {
        return Attribute::make(
            get:fn(string $value)=>ucwords($value)
        );
    }

    protected function casts() : array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
