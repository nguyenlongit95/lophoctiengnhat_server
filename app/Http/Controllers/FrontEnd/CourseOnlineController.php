<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CourseOnline\CourseOnlineRepositoryInterface;
use App\Repositories\Menus\MenusRepositoryInterface;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Http\Request;

class CourseOnlineController extends Controller
{
    /**
     * @var MenusRepositoryInterface
     * @var WidgetRepositoryInterface
     */
    protected $courseOnlineRepository;

    public function __construct(CourseOnlineRepositoryInterface $courseOnlineRepository)
    {
        $this->courseOnlineRepository = $courseOnlineRepository;
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
        $page = $this->courseOnlineRepository->showPages($slug);
        if ($page === false) {
            return redirect('/');
        }

        return view('frontend.pages.course_online.index', compact('page'));
    }
}
