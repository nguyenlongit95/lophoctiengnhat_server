<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseLevelQuizs\CourseLevelQuizsRepositoryInterface;
use App\Repositories\CourseLevels\CourseLevelsRepositoryInterface;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Support\ResponseHelper;
use App\Support\UploadFileHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;

class CourseLevelController extends Controller
{
    const PATH_VIDEO_COURSE_LEVEL = '/source/videos/course_level/';

    protected $pagesRepository;
    protected $courseRepository;
    protected $courseLevelQuizsRepository;
    protected $courseLevelSourceRepository;

    /**
     * PagesController constructor.
     * @param PagesRepositoryInterface $pagesRepository
     * @param CourseOnlineRepositoryInterface $courseRepository
     * @param CourseLevelSourcesRepositoryInterface $courseLevelSourcesRepository
     * @param CourseLevelQuizsRepositoryInterface $courseLevelQuizsRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseLevelsRepositoryInterface $courseRepository,
        CourseLevelSourcesRepositoryInterface $courseLevelSourcesRepository,
        CourseLevelQuizsRepositoryInterface $courseLevelQuizsRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseRepository = $courseRepository;
        $this->courseLevelSourceRepository = $courseLevelSourcesRepository;
        $this->courseLevelQuizsRepository = $courseLevelQuizsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.course_level.index', compact('courses'));
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

        return view('admin.pages.course_level.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validateCourseLevel($request);

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $store = $this->courseRepository->create($param);
        if ($store) {
            return redirect('/admin/course-level/index')->with('status', config('langVN.add_success'));
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->find($id);
        if (!$course) {
            return redirect('/admin/course-level/index')->with('status', config('langVN.data_not_found'));
        }

        $pages = $this->pagesRepository->listAll();
        $getSources = $this->courseLevelSourceRepository->getSource($course);
        $sources = $this->courseLevelSourceRepository->parseDataSource($getSources);
        $quizs = $this->courseLevelQuizsRepository->listQuiz($id);

        return view('admin.pages.course_level.edit', compact('course', 'pages', 'sources', 'quizs'));
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
        Validation::validateCourseLevel($request);

        $course = $this->courseRepository->find($id);
        if (!$course) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }

        $param = $request->all();
        $param['code'] = md5($param['slug']);
        if (isset($param['video_link_youtube']) && $param['video_link_youtube'] != null) {
            $param['video_link'] = $param['video_link_youtube'];
            $param['video_type'] = 0;
        }
        if (isset($param['video_link_driver']) && $param['video_link_driver'] != null) {
            $param['video_link'] = $param['video_link_driver'];
            $param['video_type'] = 1;
        }
        if (isset($param['video_link_upload']) && $param['video_link_upload'] != null) {
            $upload = app()->make(UploadFileHelper::class)->uploadVideos($request, $id, self::PATH_VIDEO_COURSE_LEVEL);
            if ($upload === 0) {
                return redirect('/admin/course-thematic/'.$id.'/edit')->with('status', config('langVN.chose_file_video'));
            } else if ($upload === 1) {
                return redirect('/admin/course-thematic/'.$id.'/edit')->with('status', config('langVN.video_err_ext'));
            } else {
                $param['video_link'] = $upload;
                $param['video_type'] = 2;
            }
        }

        $update = $this->courseRepository->update($param, $id);
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
        $course = $this->courseRepository->find($id);
        if (!$course) {
            return redirect('/admin/course-level/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->courseRepository->checkDependentDataSource($course->id);
        if ($checkDependentData == false) {
            return redirect('/admin/course-level/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        return redirect('/admin/course-level/index')->with('status', config('langVN.delete_success'));
    }
}
