<?php

namespace App\Repositories\CourseFreeQuizs;

interface CourseFreeQuizsRepositoryInterface
{
    /**
     * @param $courseId
     * @return mixed
     */
    public function listQuiz($courseId);
}
