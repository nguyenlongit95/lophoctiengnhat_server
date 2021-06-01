<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionDetails\QuestionDetailsRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionDetailController extends Controller
{
    protected $questionDetailRepository;

    /**
     * PagesController constructor.
     * @param  QuestionDetailsRepositoryInterface  $questionDetailRepository
     */
    public function __construct(
        QuestionDetailsRepositoryInterface $questionDetailRepository
    ) {
        $this->questionDetailRepository = $questionDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $param = $request->all();

        Validation::validateQuestionDetail($request);

        $create = $this->questionDetailRepository->create($param);
        if (!$create) {
            return redirect()->back()->with('status', config('langVN.add_failed'));
        }

        return redirect()->back()->with('status', config('langVN.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        Validation::validateQuestionDetail($request);

        $quiz = $this->questionDetailRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }
        $update = $this->questionDetailRepository->update($param, $id);
        if (!$update) {
            return redirect()->back()->with('status', config('langVN.update_failed'));
        }

        return redirect()->back()->with('status', config('langVN.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
