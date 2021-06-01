<?php

namespace App\Repositories\CourseOnline;

use App\Models\CourseOnline;
use App\Models\CourseOnlineSource;
use App\Models\Pages;
use App\Repositories\Eloquent\EloquentRepository;

class CourseOnlineEloquentRepository extends EloquentRepository implements CourseOnlineRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseOnline::class;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function showPages($slug)
    {
        $courseOnline = Pages::where('slug', $slug)->first();
        if (empty($courseOnline)) {
            return false;
        }

        return $courseOnline;
    }

    /**
     * Function check data depenend
     *
     * @param $course
     * @return mixed
     */
    public function checkDataDependent($course)
    {
        $data = CourseOnlineSource::where('course_online_id', $course->id)->count();
        if ($data > 0) {
            return false;
        }

        return true;
    }
}
