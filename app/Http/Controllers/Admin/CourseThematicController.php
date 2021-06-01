<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseThematics\CourseThematicsRepositoryInterface;
use App\Repositories\CourseThematicsSource\CourseThematicSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Support\UploadFileHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;

class CourseThematicController extends Controller
{
    const PATH_VIDEO_COURSE_THEMATIC = '/source/videos/course_thematic/';

    protected $pagesRepository;
    protected $courseThematicRepository;
    protected $courseThematicSourceRepository;

    /**
     * PagesController constructor.
     * @param  PagesRepositoryInterface  $pagesRepository
     * @param  CourseThematicsRepositoryInterface  $courseThematicRepository
     * @param  CourseThematicSourcesRepositoryInterface  $courseThematicSourceRepository
     */

    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseThematicsRepositoryInterface $courseThematicRepository,
        CourseThematicSourcesRepositoryInterface $courseThematicSourceRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseThematicRepository = $courseThematicRepository;
        $this->courseThematicSourceRepository = $courseThematicSourceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseThematicRepository->getAll(config('const.paginate'), 'DESC');

        return view('admin.pages.course_thematic.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = $this->pagesRepository->listAll();

        return view('admin.pages.course_thematic.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validateCourseThematic($request);
        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $store = $this->courseThematicRepository->create($param);
        if ($store) {
            return redirect('/admin/course-thematic/index')->with('status', config('langVN.add_success'));
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
        $course = $this->courseThematicRepository->find($id);
        if (!$course) {
            return redirect('/admin/course-thematic/index')->with('status', config('langVN.data_not_found'));
        }

        $pages = $this->pagesRepository->listAll();
        $sources = $this->courseThematicSourceRepository->getSource($course);

        return view('admin.pages.course_thematic.edit', compact('course', 'pages', 'sources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request, $id)
    {
        Validation::validateCourseThematic($request);

        $course = $this->courseThematicRepository->find($id);
        if (!$course) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }

        $param = $request->all();
        $param['code'] = md5($param['slug']);
        // Check video type and update or create video video_type: 0: youtube, 1: driver, 2: upload
        if (isset($param['video_link_youtube']) && $param['video_link_youtube'] != null) {
            $param['video_link'] = $param['video_link_youtube'];
            $param['video_type'] = 0;
        }
        if (isset($param['video_link_driver']) && $param['video_link_driver'] != null) {
            $param['video_link'] = $param['video_link_driver'];
            $param['video_type'] = 1;
        }
        if (isset($param['video_link_upload']) && $param['video_link_upload'] != null) {
            $upload = app()->make(UploadFileHelper::class)->uploadVideos($request, $id, self::PATH_VIDEO_COURSE_THEMATIC);
            if ($upload === 0) {
                return redirect('/admin/course-thematic/'.$id.'/edit')->with('status', config('langVN.chose_file_video'));
            } else if ($upload === 1) {
                return redirect('/admin/course-thematic/'.$id.'/edit')->with('status', config('langVN.video_err_ext'));
            } else {
                $param['video_link'] = $upload;
                $param['video_type'] = 2;
            }
        }

        $update = $this->courseThematicRepository->update($param, $id);
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
        $course = $this->courseThematicRepository->find($id);

        if (!$course) {
            return redirect('/admin/course-thematic/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->courseThematicRepository->checkDependentDataSource($course->id);

        if ($checkDependentData == false) {
            return redirect('/admin/course-thematic/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->courseThematicRepository->delete($id);
        if ($delete == true) {
            return redirect('/admin/course-thematic/index')->with('status', config('langVN.delete_success'));
        }
    }
}
