<?php


namespace App\Strategy;

use App\Course;

class AdminFormato implements Formato
{
    public function visualizar(Course $course) {

        $course->load([
            'category' => function ($q) {
                $q->select('id', 'name');
            },
            'goals' => function ($q) {
                $q->select('id', 'course_id', 'goal');
            },
            'level' => function ($q) {
                $q->select('id', 'name');
            },
            'requirements' => function ($q) {
                $q->select('id', 'course_id', 'requirement');
            },
            'reviews.user',
            'teacher'
        ])->get();

        $related = $course->relatedCourses();

        $vista = "courses.admin";

        return [$vista,$course,$related];

    }
}