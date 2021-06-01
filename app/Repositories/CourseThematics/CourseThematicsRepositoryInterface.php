<?php

namespace App\Repositories\CourseThematics;

interface CourseThematicsRepositoryInterface
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
    public function getCourseUsingSlug($slug);
}
