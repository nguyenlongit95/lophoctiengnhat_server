<?php

namespace App\Repositories\CourseFreeQuizs;

use App\Models\CourseFreeQuizs;
use App\Repositories\Eloquent\EloquentRepository;

class CourseFreeQuizsEloquentRepository extends EloquentRepository implements CourseFreeQuizsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseFreeQuizs::class;
    }

    /**
     * Function list quiz of course level
     *
     * @param $courseId
     * @return mixed
     */
    public function listQuiz($courseId)
    {
        $quiz = CourseFreeQuizs::where('course_free_id', $courseId)->get();

        return $quiz;
    }
}
