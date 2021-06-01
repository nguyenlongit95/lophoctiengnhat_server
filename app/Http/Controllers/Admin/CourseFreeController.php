<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseFreeQuizs\CourseFreeQuizsRepositoryInterface;
use App\Repositories\CourseFrees\CourseFreesRepositoryInterface;
use App\Repositories\CourseFreeSources\CourseFreeSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseFreeController extends Controller
{
    protected $pagesRepository;
    protected $courseFreeRepository;
    protected $courseFreeSourceRepository;
    protected $courseFreeQuizsRepository;

    /**
     * PagesController constructor.
     * @param  PagesRepositoryInterface  $pagesRepository
     * @param  CourseFreesRepositoryInterface  $courseFreeRepository
     * @param  CourseFreeSourcesRepositoryInterface  $courseFreeSourceRepository
     * @param  CourseFreeQuizsRepositoryInterface  $courseFreeQuizsRepository
     */

    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseFreesRepositoryInterface $courseFreeRepository,
        CourseFreeSourcesRepositoryInterface $courseFreeSourceRepository,
        CourseFreeQuizsRepositoryInterface $courseFreeQuizsRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseFreeRepository = $courseFreeRepository;
        $this->courseFreeSourceRepository = $courseFreeSourceRepository;
        $this->courseFreeQuizsRepository = $courseFreeQuizsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = $this->courseFreeRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.course_free.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pages = $this->pagesRepository->listAll();

        return view('admin.pages.course_free.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Validation::validateCourseFree($request);

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $store = $this->courseFreeRepository->create($param);
        if ($store) {
            return redirect('/admin/course-free/index')->with('status', config('langVN.add_success'));
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $course = $this->courseFreeRepository->find($id);
        if (!$course) {
            return redirect('/admin/course-free/index')->with('status', config('langVN.data_not_found'));
        }

        $pages = $this->pagesRepository->listAll();
        $sources = $this->courseFreeSourceRepository->getSource($course);
        $quizs = $this->courseFreeQuizsRepository->listQuiz($id);

        return view('admin.pages.course_free.edit', compact('course', 'pages', 'sources', 'quizs'));
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
        Validation::validateCourseFree($request);

        $course = $this->courseFreeRepository->find($id);
        if (!$course) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $update = $this->courseFreeRepository->update($param, $id);
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
        $course = $this->courseFreeRepository->find($id);

        if (!$course) {
            return redirect('/admin/course-free/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->courseFreeRepository->checkDependentDataSource($course->id);
        if ($checkDependentData == false) {
            return redirect('/admin/course-free/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->courseFreeRepository->delete($id);
        if ($delete == true) {
            return redirect('/admin/course-free/index')->with('status', config('langVN.delete_success'));
        }
    }
}
