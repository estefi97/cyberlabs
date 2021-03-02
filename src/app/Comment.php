<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const DELETED = 2;

    public function users () {
        return $this->belongsToMany(User::class,'comment_user')
            ->withPivot('user_id');
    }

    public function articles () {
        return $this->belongsToMany(Article::class, 'article_comment')
            ->withPivot('article_id');
    }

    public function webinars () {
        return $this->belongsToMany(Webinar::class,'webinar_comment')
            ->withPivot('webinar_id');
    }

}