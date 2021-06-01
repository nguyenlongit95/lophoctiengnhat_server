<?php

namespace App\Repositories\CourseLevelQuizs;

use App\Models\CourseLevelQuizs;
use App\Repositories\Eloquent\EloquentRepository;

class CourseLevelQuizsEloquentRepository extends EloquentRepository implements CourseLevelQuizsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseLevelQuizs::class;
    }

    /**
     * Function list quiz of course level
     *
     * @param $courseId
     * @return mixed
     */
    public function listQuiz($courseId)
    {
        $quiz = CourseLevelQuizs::where('course_level_id', $courseId)->get();

        return $quiz;
    }
}
