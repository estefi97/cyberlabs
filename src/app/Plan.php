<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const DELETED = 2;

    public function features () {
        return $this->belongsToMany(Feature::class,'plan_feature')
            ->withPivot('feature_id','benefit');
    }
}
