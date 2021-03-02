<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'picture', 'status'];

    const PUBLISHED = 1;
    const DELETED = 2;

    public function pathAttachment () {
        return "/images/articles/" . $this->picture;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function comments () {
        return $this->belongsToMany(Comment::class,'article_comment')
            ->withPivot('comment_id');
    }

    public function users () {
        return $this->belongsToMany(User::class, 'article_user')
            ->withPivot('user_id');
    }

}
