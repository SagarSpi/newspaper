<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];

    protected function Status(): Attribute {
        return Attribute::make(
            get: fn(?string $value) => $value ? ucwords($value) : null
        );
    }
    
    protected function CreatedAt() : Attribute {
        return Attribute::make(
            get: fn(string $value)=>date('d-M-Y',strtotime($value))
        );
    }
}
