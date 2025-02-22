<?php

namespace App\Models\Backend;

use App\Models\Backend\User;
use App\Models\Frontend\Comment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'shortDesc',
        'image_url',
        'image_id',
        'description',
        'tags',
        'user_id',
        'status',
    ];

    protected $hidden = [
        'user_id',
    ];
    // ONE TO MANY RELATION POLYMORPHIC
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
    public function letestComment()
    {
        return $this->morphOne(Comment::class,'commentable')
                    ->latestOfMany();
    }
    public function oldestComment()
    {
        return $this->morphOne(Comment::class,'commentable')
                    ->oldestOfMany();
    }
    // ONE TO MANY RELATION 
    public function user() {
        return $this->belongsTo(User::class)->select(['id', 'name', 'email', 'image_url', 'contacts', 'role']);
    }

    protected function Category() : Attribute {
        return Attribute::make(
            get: fn(string $value)=>ucwords($value)
        );
    }
    protected function Status() : Attribute {
        return Attribute::make(
            get:fn(string $value)=>ucwords($value)
        );
    }
    protected function CreatedAt() : Attribute{
        return Attribute::make(
            get: fn(string $value)=>date('d M Y', strtotime($value))
        );
    }
    protected function UpdatedAt(): Attribute {
        return Attribute::make(
            get: fn(string $value)=>date('d M Y',strtotime($value))
        );
    }
}
