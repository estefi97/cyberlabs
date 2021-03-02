<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use SoftDeletes;

    public function plans () {
        return $this->belongsToMany(Plan::class,'plan_feature')
            ->withPivot('plan_id','benefit');
    }
}