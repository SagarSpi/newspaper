<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'otp',
        'expired_at',
    ];
}
