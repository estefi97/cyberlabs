<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'picture', 'level_id', 'status'];

    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    protected $withCount = ['courses'];

    public static function boot () {
        parent::boot();

        static::saving(function(Specialty $specialty) {
            if( ! \App::runningInConsole() ) {
                $specialty->slug = str_slug($specialty->name, "-");
            }
        });

        static::saved(function (Specialty $specialty) {
            if ( ! \App::runningInConsole()) {
                if ( request('requirements')) {
                    foreach (request('requirements') as $key => $requirement_input) {
                        if ($requirement_input) {
                            Requirement::updateOrCreate(['id' => request('requirement_id'. $key)], [
                                'specialty_id' => $specialty->id,
                                'requirement' => $requirement_input
                            ]);
                        }
                    }
                }

                if(request('goals')) {
                    foreach(request('goals') as $key => $goal_input) {
                        if( $goal_input) {
                            Goal::updateOrCreate(['id' => request('goal_id'.$key)], [
                                '$specialty_id' => $specialty->id,
                                'goal' => $goal_input
                            ]);
                        }
                    }
                }
            }
        });
    }

    public function pathAttachment () {
        return "/images/specialties/" . $this->picture;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function goals () {
        return $this->belongsToMany(Goal::class,'goal_specialty')
            ->withPivot('goal_id');
    }

    public function level () {
        return $this->belongsTo(Level::class)->select('id', 'name');
    }

    public function requirements () {
        return $this->belongsToMany(Requirement::class,'requirement_specialty')
            ->withPivot('requirement_id');
    }

    public function courses () {
        return $this->belongsToMany(Course::class, 'course_specialty')
            ->withPivot('course_id');
    }


}