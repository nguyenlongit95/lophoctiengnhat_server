<?php

namespace App\Repositories\Questions;

use App\Models\Pages;
use App\Models\QuestionDetails;
use App\Models\Questions;
use App\Repositories\Eloquent\EloquentRepository;

class QuestionsEloquentRepository extends EloquentRepository implements QuestionsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Questions::class;
    }
    /**
     * Check for the dependent data of the record
     * @param $id
     * @return bool
     */
    public function checkDependentData($id)
    {
        $checkSource = QuestionDetails::where('question_id', $id)->count();
        if ($checkSource > 0) {
            return false;
        }

        return true;
    }

    /**
     * SQL function get question using slug
     *
     * @param $slug
     * @return mixed
     */
    public function pageQuestion($slug)
    {
        return Pages::where('slug', $slug)->first();
    }

    /**
     * SQL function get question using page id
     *
     * @param $page
     * @return mixed
     */
    public function getQuestion($page)
    {
        return Questions::where('page_id', $page->id)->orderBy('id', 'ASC')->get();
    }

    /**
     * SQL function list page question
     *
     * @return mixed
     */
    public function listQA()
    {
       return Pages::where('menu_id', 5)->orderBy('name', 'ASC')->get();
    }


    /**
     * SQL function find a question using slug
     *
     * @param string $question slug of question
     * @return mixed
     */
    public function findQuestionUsingSlug($question)
    {
        return Questions::where('slug', $question)->first();
    }
}
