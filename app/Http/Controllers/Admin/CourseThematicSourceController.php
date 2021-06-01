<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseLevels\CourseLevelsRepositoryInterface;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\CourseThematics\CourseThematicsRepositoryInterface;
use App\Repositories\CourseThematicsSource\CourseThematicSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Support\ResponseHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class CourseThematicSourceController extends Controller
{
    protected $pagesRepository;
    protected $courseRepository;
    protected $courseThematicSourceRepository;
    protected $courseLevelSourceRepository;

    /**
     * PagesController constructor.
     * @param  PagesRepositoryInterface  $pagesRepository
     * @param  CourseLevelsRepositoryInterface  $courseRepository
     * @param  CourseThematicSourcesRepositoryInterface  $courseThematicSourceRepository
     * @param  CourseLevelSourcesRepositoryInterface  $courseLevelSourceRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseThematicsRepositoryInterface $courseRepository,
        CourseThematicSourcesRepositoryInterface $courseThematicSourceRepository,
        CourseLevelSourcesRepositoryInterface $courseLevelSourceRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseRepository = $courseRepository;
        $this->courseThematicSourceRepository = $courseThematicSourceRepository;
        $this->courseLevelSourceRepository = $courseLevelSourceRepository;
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
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Bạn hãy nhập tên',
        ]);

        // create source
        try {
            $this->courseThematicSourceRepository->create($param);
            return redirect()->back()->with('status', config('langVN.add_success'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
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
        $source = $this->courseThematicSourceRepository->find($id);
        if (!$source) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }
        $param = $request->all();

        // update source
        try {
            $this->courseThematicSourceRepository->update($param, $id);
            return redirect()->back()->with('status', config('langVN.update_success'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return redirect()->back()->with('status', config('langVN.update_failed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->courseThematicSourceRepository->delete($id);
        if ($delete == false) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }

    /**
     * Function controller render view word using blade view render
     *
     * @param Request $request
     * @param int $id of lesson
     * @param int $courseId of pages
     * @return array|string
     * @throws \Throwable
     */
    public function renderViewWord(Request $request, $id, $courseId)
    {
        $param = $request->all();
        $words = $this->courseThematicSourceRepository->getWordOfLesson($id);

        return view('admin.pages.course_thematic.partials.words', compact('words', 'param', 'id', 'courseId'));
    }

    /**
     * Function api controller add new word in lesson
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function wordAdd(Request $request)
    {
        $param = $request->all();
        $add = $this->courseThematicSourceRepository->wordAdd($param, $request);
        if ($add === 1) {
            return redirect()->back()->with('status', config('langVN.add_word.success'));
        }

        return redirect()->back()->with('status', config('langVN.add_word.failed'));
    }

    /**
     * Function api controller update word of lesson
     *
     * @param Request $request
     * @param Request $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function wordEdit(Request $request, $id)
    {
        $param = $request->all();
        $param['id'] = $id;
        $updateWord = $this->courseThematicSourceRepository->updateWord($param, $request);
        if ($updateWord) {
            return redirect()->back()->with('status', config('langVN.edit_word.success'));
        }

        return redirect()->back()->with('status', config('langVN.edit_word.failed'));
    }

    /**
     * Function delete an word
     *
     * @param Request $request
     * @param int $id of word
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wordDelete(Request $request, $id)
    {
        $delete = $this->courseThematicSourceRepository->deleteWord($id);
        if ($delete) {
            return redirect()->back()->with('status', config('langVN.deleted_word.success'));
        }

        return redirect()->back()->with('status', config('langVN.deleted_word.failed'));
    }
}
