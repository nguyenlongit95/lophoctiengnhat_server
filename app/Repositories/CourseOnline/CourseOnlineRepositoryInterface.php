<?php

namespace App\Repositories\CourseOnline;

interface CourseOnlineRepositoryInterface
{
    /**
     * @param $slug
     * @return mixed
     */
    public function showPages($slug);

    /**
     * @param $course
     * @return mixed
     */
    public function checkDataDependent($course);
}
