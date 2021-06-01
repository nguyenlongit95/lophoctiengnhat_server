<?php

namespace App\Repositories\Questions;

interface QuestionsRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function checkDependentData($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function pageQuestion($slug);

    /**
     * @param $page
     * @return mixed
     */
    public function getQuestion($page);

    /**
     * @return mixed
     */
    public function listQA();

    /**
     * @param $question
     * @return mixed
     */
    public function findQuestionUsingSlug($question);
}
