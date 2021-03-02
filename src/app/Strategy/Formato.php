<?php


namespace App\Strategy;

use App\Course;

interface Formato
{
    public function visualizar(Course $course);
}