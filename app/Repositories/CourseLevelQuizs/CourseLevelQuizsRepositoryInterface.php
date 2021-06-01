<?php

namespace App\Repositories\CourseLevelQuizs;

interface CourseLevelQuizsRepositoryInterface
{
    /**
     * @param $courseId
     * @return mixed
     */
    public function listQuiz($courseId);
}
