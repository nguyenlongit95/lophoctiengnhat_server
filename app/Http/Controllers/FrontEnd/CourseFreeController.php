<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CourseFreeQuizs\CourseFreeQuizsRepositoryInterface;
use App\Repositories\CourseFrees\CourseFreesRepositoryInterface;
use App\Repositories\CourseFreeSources\CourseFreeSourcesRepositoryInterface;
use Illuminate\Http\Request;

class CourseFreeController extends Controller
{
   private $courseFreeRepository;
   private $courseFreeSourceRepository;
   private $courseFreeQuizRepository;

    public function __construct(
        CourseFreesRepositoryInterface $courseFreeRepository,
        CourseFreeSourcesRepositoryInterface $courseFreeSourceRepository,
        CourseFreeQuizsRepositoryInterface $courseFreeQuizRepository
    )
    {
        $this->courseFreeRepository = $courseFreeRepository;
        $this->courseFreeSourceRepository = $courseFreeSourceRepository;
        $this->courseFreeQuizRepository = $courseFreeQuizRepository;
    }

    public function index(Request $request)
    {
        $courseFrees = $this->courseFreeRepository->listAll();

        return view('frontend.pages.course_free.index', compact('courseFrees'));
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
        $courseFrees = $this->courseFreeRepository->findCourse($slug);
        if (empty($courseFrees)) {
            return redirect('/');
        }
        $courseFreeSource = $this->courseFreeSourceRepository->getSource($courseFrees);
        $courseFreeQuiz = $this->courseFreeQuizRepository->listQuiz($courseFrees->id);

        return view('frontend.pages.course_free.course_show', compact(
            'courseFrees', 'courseFreeSource', 'courseFreeQuiz'
        ));
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
        return view('frontend.pages.course_free.course_detail');
    }
}
