<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseOnline\CourseOnlineRepositoryInterface;
use App\Repositories\Menus\MenusRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Support\ResponseHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $pagesRepository;
    protected $menuRepository;
    protected $courseOnline;

    /**
     * PagesController constructor.
     * @param PagesRepositoryInterface $pagesRepository
     * @param MenusRepositoryInterface $menuRepository
     * @param CourseOnlineRepositoryInterface $courseOnlineRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        MenusRepositoryInterface $menuRepository,
        CourseOnlineRepositoryInterface $courseOnlineRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->menuRepository = $menuRepository;
        $this->courseOnline = $courseOnlineRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pagesRepository->listAll();

        return view('admin.pages.page.index', compact('pages'));
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
        $menus = $this->menuRepository->getAllMenus();

        return view('admin.pages.page.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validatePageWeb($request);
        $param = $request->all();

        $store = $this->pagesRepository->create($param);
        if ($store) {
            return redirect('/admin/pages/index')->with('status', config('langVN.add_success'));
        }

        return redirect('/admin/pages/create')->with('status', config('langVN.add_failed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = $this->menuRepository->getAllMenus();
        $page = $this->pagesRepository->find($id);
        if (!$page) {
            return redirect('/admin/pages/index')->with('status', config('langVN.data_not_found'));
        }

        return view('admin.pages.page.edit', compact('menus', 'page'));
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
        Validation::validatePageWeb($request);

        $param = $request->all();
        $update = $this->pagesRepository->update($param, $id);
        if ($update) {
            return redirect('/admin/pages/' . $id . '/edit')->with('status', config('langVN.update_success'));
        }

        return redirect('/admin/pages/' . $id . '/edit')->with('status', config('langVN.update_failed'));
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
        $page = $this->pagesRepository->find($id);
        if (!$page) {
            return redirect('/admin/pages/index')->with('status', config('langVN.data_not_found'));
        }
        $checkCourse = $this->pagesRepository->checkCourse($page);
        if ($checkCourse == false) {
            return redirect('/admin/pages/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->pagesRepository->delete($id);
        if (!$delete) {
            return redirect('/admin/pages/index')->with('status', config('langVN.delete_failed'));
        }

        return redirect('/admin/pages/index')->with('status', config('langVN.delete_success'));
    }
}
