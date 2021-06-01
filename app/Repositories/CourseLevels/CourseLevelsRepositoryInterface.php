<?php

namespace App\Repositories\CourseLevels;

interface CourseLevelsRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function checkDependentDataSource($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function showPage($slug);

    /**
     * @param $page
     * @return mixed
     */
    public function getCourseLevel($page);

    /**
     * @param $course
     * @return mixed
     */
    public function findCourse($course);

    /**
     * @param $course
     * @return mixed
     */
    public function courseDetail($course);

    /**
     * @param $course
     * @return mixed
     */
    public function getQuizOfCourse($course);
}
