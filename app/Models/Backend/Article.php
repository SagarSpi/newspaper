<?php

namespace App\Models\Backend;

use App\Models\Backend\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class)->select(['id', 'name', 'email', 'contacts', 'role']);
    }
    protected function CreatedAt() : Attribute{
        return Attribute::make(
            get: fn(string $value)=> date('d M Y', strtotime($value))
        );
    }
    protected function UpdatedAt(): Attribute {
        return Attribute::make(
            get: fn(string $value)=>date('d M Y',strtotime($value))
        );
    }

}
