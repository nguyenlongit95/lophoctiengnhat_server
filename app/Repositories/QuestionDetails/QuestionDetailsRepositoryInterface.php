<?php

namespace App\Repositories\QuestionDetails;

interface QuestionDetailsRepositoryInterface
{
    /**
     * @param $question
     * @return mixed
     */
    public function getQuestion($question);
}
