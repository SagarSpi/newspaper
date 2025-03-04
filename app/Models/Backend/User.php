<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'ip_address',
        'password',
        'contacts',
        'image_url',
        'image_id',
        'role',
        'status',
        'auth_provider',
        'auth_provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class)
                ->select(['id', 'title', 'category', 'shortDesc', 'image_url', 'visits','user_id','status']);
    }

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
    protected function CreatedAt() : Attribute{
        return Attribute::make(
            get: fn(string $value)=>date('d M Y', strtotime($value))
        );
    }
    
    protected function casts() : array
    {
        return [
            'password' => 'hashed',
            'last_seen' => 'datetime',
        ];
    }
}
