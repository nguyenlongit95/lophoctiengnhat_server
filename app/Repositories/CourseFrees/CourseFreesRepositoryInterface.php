<?php

namespace App\Repositories\CourseFrees;

interface CourseFreesRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function checkDependentDataSource($id);
    /**
     * @return mixed
     */
    public function getNewCourse();
    /**
     * @return mixed
     */
    public function getFourCourseAfter();
    /**
     * @param $slug
     * @return mixed
     */
    public function findCourse($slug);
}
