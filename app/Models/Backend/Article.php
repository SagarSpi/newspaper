<?php

namespace App\Models\Backend;

use App\Models\Backend\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
