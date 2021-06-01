<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseOnline\CourseOnlineRepositoryInterface;
use App\Repositories\CourseOnlineSource\CourseOnlineSourceRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;

class CourseOnlineController extends Controller
{
    protected $pagesRepository;
    protected $courseRepository;
    protected $courseOnlineSourceRepository;

    /**
     * PagesController constructor.
     * @param PagesRepositoryInterface $pagesRepository
     * @param CourseOnlineRepositoryInterface $courseRepository
     * @param CourseOnlineSourceRepositoryInterface $courseOnlineSourceRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseOnlineRepositoryInterface $courseRepository,
        CourseOnlineSourceRepositoryInterface $courseOnlineSourceRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseRepository = $courseRepository;
        $this->courseOnlineSourceRepository = $courseOnlineSourceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.course_online.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function create()
    {
        $pages = $this->pagesRepository->listAll();

        return view('admin.pages.course_online.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validateCourseOnline($request);

        $param = $request->all();
        $code = md5($param['link']);
        $param['code'] = $code;
        $create = $this->courseRepository->create($param);
        if (!$create) {
            return redirect()->back()->with('status', config('langVN.add_failed'));
        }

        return redirect('/admin/course-online/index')->with('status', config('langVN.add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = $this->pagesRepository->listAll();
        $courseOnline = $this->courseRepository->find($id);
        if (!$courseOnline) {
            return redirect('/admin/course-online/index')->with('status', config('langVN.data_not_found'));
        }
        $courseOnlineSource = $this->courseOnlineSourceRepository->listSource($courseOnline);

        return view('admin.pages.course_online.edit', compact(
            'courseOnline', 'courseOnlineSource', 'pages'
        ));
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
        Validation::validateCourseOnline($request);

        $param = $request->all();
        $code = md5($param['link']);
        $param['code'] = $code;
        $update = $this->courseRepository->update($param, $id);
        if (!$update) {
            return redirect()->back()->with('status', config('langVN.update_failed'));
        }

        return redirect('/admin/course-online/' . $id . '/edit')->with('status', config('langVN.update_success'));
    }

    /**
     * function render view add master menu
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        return view('admin.pages.menus.add');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->find($id);
        if (!$course) {
            return redirect('/admin/course-online/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->courseRepository->checkDataDependent($course);
        if ($checkDependentData == false) {
            return redirect('/admin/course-online/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->courseRepository->delete($id);
        if (!$delete) {
            return redirect('/admin/course-online/index')->with('status', config('langVN.delete_failed'));
        }

        return redirect('/admin/course-online/index')->with('status', config('langVN.delete_success'));
    }

    /**
     * Controller update course source function
     *
     * @param Request $request
     * @param int $id of course resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCourseResource(Request $request, $id)
    {
        $param = $request->all();
        Validation::validateCourseOnlineSource($request);

        $update = $this->courseOnlineSourceRepository->update($param, $id);
        if ($update) {
            return redirect()->back()->with('status', config('langVN.update_success'));
        }

        return redirect()->back()->with('status', config('langVN.update_failed'));
    }

    /**
     * Function controller create new course resource
     *
     * @param Request $request
     * @param int $id of course online
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCourseResource(Request $request, $id)
    {
        $param = $request->all();
        Validation::validateCourseOnlineSource($request);

        $param['course_online_id'] = $id;
        $create = $this->courseOnlineSourceRepository->create($param);
        if ($create) {
            return redirect()->back()->with('status', config('langVN.add_success'));
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
    }

    /**
     * Controller destroy an source of course online
     *
     * @param Request $request
     * @param int $id of source
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCourseResource(Request $request, $id)
    {
        $source = $this->courseOnlineSourceRepository->find($id);
        if (!$source) {
            return redirect()->back();
        }
        $delete = $this->courseOnlineSourceRepository->delete($source->id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langVN.delete_success'));
        }

        return redirect()->back()->with('status', config('langVN.delete_failed'));
    }
}
