<?php

namespace App\Repositories\CourseFreeSources;

interface CourseFreeSourcesRepositoryInterface
{
    /**
     * @param $course
     * @return mixed
     */
    public function getSource($course);
}
