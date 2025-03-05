<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'commentable_type'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
    
    protected function CreatedAt() : Attribute{
        return Attribute::make(
            get: fn(string $value)=>date('H:i d-M-Y', strtotime($value))
        );
    }
}
