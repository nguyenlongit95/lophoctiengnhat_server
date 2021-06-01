<?php

namespace App\Repositories\CourseFrees;

use App\Models\CourseFrees;
use App\Models\CourseFreeSources;
use App\Repositories\Eloquent\EloquentRepository;

class CourseFreesEloquentRepository extends EloquentRepository implements CourseFreesRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseFrees::class;
    }

    /**
     * @return mixed
     */
    public function getNewCourse()
    {
        $course = CourseFrees::where('page_id', 4)->orderBy('id', 'DESC')->first();
        if (!$course) {
            return null;
        }

        return $course;
    }

    /**
     * @return mixed|null
     */
    public function getFourCourseAfter()
    {
        $course = CourseFrees::where('page_id', 4)->orderBy('id', 'DESC')->skip(1)->take(3)->get();
        if (!$course) {
            return null;
        }

        return $course;
    }

    /**
     * Check for the dependent data of the record
     * @param $id
     * @return bool
     */
    public function checkDependentDataSource($id)
    {
        $checkSource = CourseFreeSources::where('course_free_id', $id)->count();
        if ($checkSource > 0) {
            return false;
        }

        return true;
    }

    /**
     * Function get course using slug for frontend
     *
     * @param string $slug of course frees
     * @return mixed
     */
    public function findCourse($slug)
    {
        $courseFree = CourseFrees::where('slug', $slug)->first();

        return $courseFree;
    }
}
