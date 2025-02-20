<?php

namespace App\Models\Frontend;

use App\Models\Backend\Article;
use App\Models\Backend\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'description',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class,'commentable');
    }
    public function users()
    {
        return $this->morphedByMany(User::class,'commentable');
    }
}
