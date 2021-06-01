<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Contacts\ContactsRepositoryInterface;
use App\Repositories\CourseFrees\CourseFreesRepositoryInterface;
use App\Repositories\CourseOnline\CourseOnlineRepositoryInterface;
use App\Repositories\CourseThematics\CourseThematicsRepositoryInterface;
use App\Repositories\Menus\MenusRepositoryInterface;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // List ID menu using url index page
    const MENU_ID = [
        30,9
    ];

    const FA_ICON = [
        'fa-book', 'fa-globe', 'fa-graduation-cap', 'fa-pen-square', 'fa-university', 'fa-graduation-cap',
    ];

    const WIDGETS_ID = [
        'address', 'phone', 'email', 'facebook', 'twitter', 'googleplus',
    ];

    /**
     * @var MenusRepositoryInterface
     * @var WidgetRepositoryInterface
     */
    protected $menuRepository;
    protected $widgetRepository;
    protected $courseThematicRepository;
    protected $courseFreeRepository;
    protected $contactRepository;
    protected $courseOnlineRepository;

    /**
     * IndexController constructor.
     * @param MenusRepositoryInterface $menuRepository
     * @param WidgetRepositoryInterface $widgetRepository
     * @param CourseThematicsRepositoryInterface $courseThematicRepository
     * @param CourseFreesRepositoryInterface $courseFreeRepository
     * @param ContactsRepositoryInterface $contactRepository
     * @param CourseOnlineRepositoryInterface $courseOnlineRepository
     */
    public function __construct(
        MenusRepositoryInterface $menuRepository,
        WidgetRepositoryInterface $widgetRepository,
        CourseThematicsRepositoryInterface $courseThematicRepository,
        CourseFreesRepositoryInterface $courseFreeRepository,
        ContactsRepositoryInterface $contactRepository,
        CourseOnlineRepositoryInterface $courseOnlineRepository
    )
    {
        $this->menuRepository = $menuRepository;
        $this->widgetRepository = $widgetRepository;
        $this->courseThematicRepository = $courseThematicRepository;
        $this->courseFreeRepository = $courseFreeRepository;
        $this->contactRepository = $contactRepository;
        $this->courseOnlineRepository = $courseOnlineRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $slider = true;
        view()->share('slider', $slider);
        $headWrap = $this->menuRepository->getMenusUsingConditions('id', self::MENU_ID);
        $courseLevels = $this->menuRepository->getMenusUsingConditions('parent_id', [config('const.course_id.course_level')]);
        foreach ($courseLevels as $courseLevel) {
            $_randKey = array_rand(self::FA_ICON);
            $courseLevel->fa_icon = self::FA_ICON[$_randKey];
        }
        $courseThematics = $this->courseThematicRepository->listAll();
        $courseFrees = $this->courseFreeRepository->getFourCourseAfter();
        $newCourseFree = $this->courseFreeRepository->getNewCourse();
        foreach ($courseFrees as $courseFree) {
            $courseFree->date_create = Carbon::create($courseFree->created_at)->format('d-m-Y');
        }
        $widgets = $this->widgetRepository->listAll()->toArray();
        foreach ($widgets as $key=>$widget) {
            if (!in_array($widget['key'], self::WIDGETS_ID)) {
                unset($widgets[$key]);
            } else {
                $widgets[$key]['fa_icon'] = $this->_addFaIcon($widget['key']);
            }
        }
        $courseFreeFirst = $this->courseFreeRepository->listAll()[0];
        $courseOnline = $this->courseOnlineRepository->listAll()[0];

        return view('frontend.pages.home.home', compact(
            'headWrap', 'courseLevels', 'courseThematics',
            'courseFrees', 'newCourseFree', 'widgets',
            'courseFreeFirst', 'courseOnline'
        ));
    }

    /**
     * Function add contact
     *
     * TODO add check google confirm engine
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function addContact(Request $request)
    {
        $param = $request->all();
        $create = $this->contactRepository->create($param);
        if (!$create) {
            return null;
        }

        return redirect('');
    }

    /**
     * Function add attribute icon to widgets
     *
     * @param $key
     * @return string|null
     */
    private function _addFaIcon($key)
    {
        switch ($key) {
            case 'phone':
                return 'fa-phone';
                break;
            case 'twitter':
                return 'fa-twitter';
                break;
            case 'email':
                return 'fa-envelope';
                break;
            case 'facebook':
                return 'fa-facebook';
                break;
            case 'googleplus':
                return 'fa-google-plus';
                break;
            case 'address':
                return 'fa-home';
                break;
            default:
                return null;
                break;
        }
    }
}
