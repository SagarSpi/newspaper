<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
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
}
