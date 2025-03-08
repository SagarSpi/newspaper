<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password_reset_token extends Model
{
    use HasFactory;
    protected $guarded = [];
}
