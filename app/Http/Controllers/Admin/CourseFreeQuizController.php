<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseFreeQuizs\CourseFreeQuizsRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseFreeQuizController extends Controller
{
    protected $courseFreeQuizRepository;

    /**
     * PagesController constructor.
     * @param  CourseFreeQuizsRepositoryInterface  $courseFreeQuizRepository
     */
    public function __construct(
        CourseFreeQuizsRepositoryInterface $courseFreeQuizRepository
    ) {
        $this->courseFreeQuizRepository = $courseFreeQuizRepository;
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
        Validation::validateCourseLevelQuiz($request);

        $create = $this->courseFreeQuizRepository->create($param);
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
        Validation::validateCourseLevelQuiz($request);

        $quiz = $this->courseFreeQuizRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }
        $update = $this->courseFreeQuizRepository->update($param, $id);
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
        $quiz = $this->courseFreeQuizRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        $delete = $this->courseFreeQuizRepository->delete($id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }
}
