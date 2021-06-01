<?php

namespace App\Repositories\QuestionDetails;

use App\Models\QuestionDetails;
use App\Repositories\Eloquent\EloquentRepository;

class QuestionDetailsEloquentRepository extends EloquentRepository implements QuestionDetailsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return QuestionDetails::class;
    }

    /**
     * SQL function get question detail using id of question
     *
     * @param object $question
     * @return mixed
     */
    public function getQuestion($question)
    {
        return $this->_model->where('question_id', $question->id)->orderBy('id', 'ASC')->get();
    }
}
