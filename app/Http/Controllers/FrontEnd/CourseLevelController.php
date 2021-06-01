<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CourseLevels\CourseLevelsRepositoryInterface;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\CourseOnline\CourseOnlineRepositoryInterface;
use App\Repositories\Menus\MenusRepositoryInterface;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Http\Request;

class CourseLevelController extends Controller
{
    protected $courseLevelRepository;
    protected $courseLevelSourceRepository;

    public function __construct(
        CourseLevelsRepositoryInterface $courseLevelRepository,
        CourseLevelSourcesRepositoryInterface $courseLevelSourceRepository
    )
    {
        $this->courseLevelRepository = $courseLevelRepository;
        $this->courseLevelSourceRepository = $courseLevelSourceRepository;
    }

    /**
     * Function show course online
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $slug)
    {
        $page = $this->courseLevelRepository->showPage($slug);
        if (empty($page)) {
            return redirect('/');
        }
        $courseLevel = $this->courseLevelRepository->getCourseLevel($page);

        return view('frontend.pages.course_level.index', compact('page', 'courseLevel'));
    }

    /**
     * Controller show course detail and course of course
     *
     * @param Request $request
     * @param string $slug of the page
     * @param string $course slug of course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $slug, $course)
    {
        $course = $this->courseLevelRepository->findCourse($course);
        if (empty($course)) {
            return redirect()->back();
        }
        $courseSource = $this->courseLevelRepository->courseDetail($course->id);
        $courseLevelQuiz = $this->courseLevelRepository->getQuizOfCourse($course->id);

        return view('frontend.pages.course_level.course_detail', compact(
            'course', 'courseSource', 'courseLevelQuiz'
        ));
    }
}
