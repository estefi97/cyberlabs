<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Requirement
 *
 * @property int $id
 * @property int $course_id
 * @property string $requirement
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Course $course
 */
class Requirement extends Model
{
	protected $fillable = ['requirement'];

	public function course () {
		return $this->belongsToMany(Course::class,'requirement_course')
            ->withPivot('course_id');
	}

	public function specialty () {
	    return $this->belongsToMany(Specialty::class, 'requirement_specialty')
            ->withPivot('specialty_id');
    }
}
