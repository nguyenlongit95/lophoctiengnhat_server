<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseLevelQuizs\CourseLevelQuizsRepositoryInterface;
use App\Repositories\CourseLevels\CourseLevelsRepositoryInterface;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseLevelQuizController extends Controller
{
    protected $pagesRepository;
    protected $courseRepository;
    protected $courseLevelQuizRepository;
    /**
     * PagesController constructor.
     * @param PagesRepositoryInterface $pagesRepository
     * @param CourseLevelsRepositoryInterface $courseRepository
     * @param CourseLevelQuizsRepositoryInterface $courseLevelQuizRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseLevelsRepositoryInterface $courseRepository,
        CourseLevelQuizsRepositoryInterface $courseLevelQuizRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseRepository = $courseRepository;
        $this->courseLevelQuizRepository = $courseLevelQuizRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        Validation::validateCourseLevelQuiz($request);

        $create = $this->courseLevelQuizRepository->create($param);
        if (!$create) {
            return redirect()->back()->with('status', config('langVN.add_failed'));
        }

        return redirect()->back()->with('status', config('langVN.add_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        Validation::validateCourseLevelQuiz($request);

        $quiz = $this->courseLevelQuizRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }
        $update = $this->courseLevelQuizRepository->update($param, $id);
        if (!$update) {
            return redirect()->back()->with('status', config('langVN.update_failed'));
        }

        return redirect()->back()->with('status', config('langVN.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = $this->courseLevelQuizRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        $delete = $this->courseLevelQuizRepository->delete($id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }
}
