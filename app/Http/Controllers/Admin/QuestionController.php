<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Repositories\QuestionDetails\QuestionDetailsRepositoryInterface;
use App\Repositories\Questions\QuestionsRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questions = $this->questionsRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pages = $this->pagesRepository->listAll();

        return view('admin.pages.question.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validation::validateQuestion($request);

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $store = $this->questionsRepository->create($param);
        if ($store) {
            return redirect('/admin/question/index')->with('status', config('langVN.add_success'));
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionsRepository->find($id);
        if (!$question) {
            return redirect('/admin/question/index')->with('status', config('langVN.data_not_found'));
        }

        $pages = $this->pagesRepository->listAll();
        $questionDetails = $this->questionsDetailRepository->getQuestion($question);

        return view('admin.pages.question.edit', compact('question', 'pages', 'questionDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Validation::validateQuestion($request);

        $course = $this->questionsRepository->find($id);
        if (!$course) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $update = $this->questionsRepository->update($param, $id);
        if (!$update) {
            return redirect()->back()->with('status', config('langVN.update_failed'));
        }

        return redirect()->back()->with('status', config('langVN.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionsRepository->find($id);

        if (!$question) {
            return redirect('/admin/question/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->questionsRepository->checkDependentData($question->id);
        if ($checkDependentData == false) {
            return redirect('/admin/question/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->questionsRepository->delete($id);
        if ($delete == true) {
            return redirect('/admin/question/index')->with('status', config('langVN.delete_success'));
        }
    }
}
