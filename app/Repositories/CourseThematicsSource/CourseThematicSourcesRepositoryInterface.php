<?php

namespace App\Repositories\CourseThematicsSource;

use http\Env\Request;

interface CourseThematicSourcesRepositoryInterface
{
    /**
     * @param $course
     * @return mixed
     */
    public function getSource($course);

    /**
     * @param $slug
     * @return mixed
     */
    public function getSourceUsingSlug($slug);

    /**
     * @param $idSource
     * @return mixed
     */
    public function getWordOfLesson($idSource);

    /**
     * @param array $param
     * @param $request
     * @return mixed
     */
    public function updateWord($param, $request);

    /**
     * @param $param
     * @param $request
     * @return mixed
     */
    public function wordAdd($param, $request);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteWord($id);
}
