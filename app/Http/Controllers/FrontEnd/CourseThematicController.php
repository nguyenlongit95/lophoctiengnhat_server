<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CourseThematics\CourseThematicsRepositoryInterface;
use App\Repositories\CourseThematicsSource\CourseThematicSourcesEloquentRepository;
use Illuminate\Http\Request;

class CourseThematicController extends Controller
{
    /**
     * @var CourseThematicsRepositoryInterface
     */
    protected $courseThematicRepository;
    protected $courseThematicSourceRepository;

    /**
     * CourseThematicController constructor.
     * @param CourseThematicsRepositoryInterface $courseThematicRepository
     * @param CourseThematicSourcesEloquentRepository $courseThematicSourceRepository
     */
    public function __construct(
        CourseThematicsRepositoryInterface $courseThematicRepository,
        CourseThematicSourcesEloquentRepository $courseThematicSourceRepository
    ) {
        $this->courseThematicRepository = $courseThematicRepository;
        $this->courseThematicSourceRepository = $courseThematicSourceRepository;
    }

    /**
     * Function render view using slug of course
     *
     * @param Request $request
     * @param $slug string
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $slug)
    {
        $course = $this->courseThematicRepository->getCourseUsingSlug($slug);
        if (empty($course)) {
            return redirect('/');
        }
        // Lesson of course
        $sources = $this->courseThematicSourceRepository->getSource($course);

        return view('frontend.pages.course_thematic.index', compact('course', 'sources'));
    }

    /**
     * Controller render view detail lesson
     *
     * @param Request $request
     * @param string $course slug of course
     * @param string $lesson slug of lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $course, $lesson)
    {
        $course = $this->courseThematicRepository->getCourseUsingSlug($course);
        if (empty($course)) {
            return redirect('/');
        }
        $source = $this->courseThematicSourceRepository->getSourceUsingSlug($lesson);
        if (empty($source)) {
            return redirect('/');
        }
        $words = $this->courseThematicSourceRepository->getWordOfLesson($source->id);

        return view('frontend.pages.course_thematic.detail', compact('course', 'source', 'words'));
    }
}
