<?php

namespace App;

use App\State\ModuleContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Helpers\Helper;

/**
 * App\Course
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Goal[] $goals
 * @property-read \App\Level $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Requirement[] $requirements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \App\Teacher $teacher
 */
class Course extends Model
{

    //////////////////////////////////////////////
    ///         BEGIN: PATRON STRATEGY        ///
    ////////////////////////////////////////////

    public function show (Course $course, Strategy\Formato $formato) {
        $this->formato = $formato;
        list($vista,$courseData,$related) = $this->formato->visualizar($course);
        return [$vista,$courseData,$related];
    }

    ////////////////////////////////////////////
    ///         END: PATRON STRATEGY        ///
    //////////////////////////////////////////


	use SoftDeletes;

	protected $fillable = ['teacher_id', 'name', 'description', 'picture', 'level_id', 'category_id', 'status'];

	const PUBLISHED = 1;
	const PENDING = 2;
	const REJECTED = 3;

	protected $withCount = ['students'];

	public static function boot () {
		parent::boot();

		static::saving(function(Course $course) {
			if( ! \App::runningInConsole() ) {
				$course->slug = str_slug($course->name, "-");
			}
		});

		static::saved(function (Course $course) {
			if ( ! \App::runningInConsole()) {
				if ( request('requirements')) {
					foreach (request('requirements') as $key => $requirement_input) {
						if ($requirement_input) {
							Requirement::updateOrCreate(['id' => request('requirement_id'. $key)], [
								'course_id' => $course->id,
								'requirement' => $requirement_input
							]);
						}
					}
				}

				if(request('goals')) {
					foreach(request('goals') as $key => $goal_input) {
						if( $goal_input) {
							Goal::updateOrCreate(['id' => request('goal_id'.$key)], [
								'course_id' => $course->id,
								'goal' => $goal_input
							]);
						}
					}
				}
			}
		});
	}

	public function pathAttachment () {
		return "/images/courses/" . $this->picture;
	}

	public function getRouteKeyName() {
		return 'slug';
	}

	public function category () {
		return $this->belongsTo(Category::class)->select('id', 'name');
	}

	public function goals () {
		return $this->belongsToMany(Goal::class,'goal_course')
            ->withPivot('goal_id');
	}

	public function level () {
		return $this->belongsTo(Level::class)->select('id', 'name');
	}

	public function reviews () {
		return $this->belongsToMany(Review::class,'review_course')
            ->withPivot('review_id');
	}

	public function requirements () {
		return $this->belongsToMany(Requirement::class, 'requirement_course')
            ->withPivot('requirement_id');
	}

	public function specialties () {
	    return $this->belongsToMany(Specialty::class, 'course_specialty')
            ->withPivot('specialty_id');
    }

    public function modules () {
	    return $this->belongsToMany(Module::class, 'module_course')
            ->withPivot('module_id');
    }

	public function students () {
		return $this->belongsToMany(Student::class);
	}

	public function teacher () {
		return $this->belongsTo(Teacher::class);
	}

	public function getCustomRatingAttribute () {
		return $this->reviews->avg('rating');
	}

	public function relatedCourses () {
		return Course::with('reviews')->whereCategoryId($this->category->id)
			->where('id', '!=', $this->id)
			->latest()
			->limit(6)
			->get();
	}
}
