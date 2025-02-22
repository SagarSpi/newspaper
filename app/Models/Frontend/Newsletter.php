<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected function CreatedAt() : Attribute {
        return Attribute::make(
            get: fn(string $value)=>date('d-M-Y',strtotime($value))
        );
    }
}
