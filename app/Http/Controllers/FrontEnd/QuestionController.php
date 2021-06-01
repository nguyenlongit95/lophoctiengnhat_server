<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Repositories\QuestionDetails\QuestionDetailsRepositoryInterface;
use App\Repositories\Questions\QuestionsRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected $pagesRepository;
    protected $questionsRepository;
    protected $questionsDetailRepository;

    /**
     * PagesController constructor.
     * @param  PagesRepositoryInterface  $pagesRepository
     * @param  QuestionsRepositoryInterface  $questionsRepository
     * @param  QuestionDetailsRepositoryInterface  $questionsDetailRepository
     */

    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        QuestionsRepositoryInterface $questionsRepository,
        QuestionDetailsRepositoryInterface $questionsDetailRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->questionsRepository = $questionsRepository;
        $this->questionsDetailRepository = $questionsDetailRepository;
    }

    /**
     * Controller show page question
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $slug)
    {
        $listPageQA = $this->questionsRepository->listQA();
        $page = $this->questionsRepository->pageQuestion($slug);
        $question = $this->questionsRepository->getQuestion($page);

        return view('frontend.pages.question.show', compact('listPageQA', 'page', 'question', 'slug'));
    }

    /**
     * Controller show detail page question
     *
     * @param Request $request
     * @param string $question
     * @param string $detail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $question, $detail)
    {
        $listPageQA = $this->questionsRepository->listQA();
        $slug = $question;
        // list page N.x
        $getQuestionPage = $this->questionsRepository->pageQuestion($question);
        if (!$getQuestionPage) {
            return redirect()->back();
        }
        // List all question
        $getQuestion = $this->questionsRepository->findQuestionUsingSlug($detail);
        if (empty($getQuestion)) {
            return redirect()->back();
        }
        // List question detail
        $detail = $this->questionsDetailRepository->getQuestion($getQuestion);

        return view('frontend.pages.question.detail', compact(
            'listPageQA', 'slug',
            'getQuestionPage', 'getQuestion',
            'detail'
        ));
    }
}
