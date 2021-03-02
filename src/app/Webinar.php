<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const INACTIVE = 2;

    public function comments () {
        return $this->belongsToMany(Comment::class,'webinar_comment')
            ->withPivot('comment_id');
    }
}
