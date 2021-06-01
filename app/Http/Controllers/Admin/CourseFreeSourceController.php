<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseFrees;
use App\Repositories\CourseFrees\CourseFreesRepositoryInterface;
use App\Repositories\CourseFreeSources\CourseFreeSourcesRepositoryInterface;
use App\Repositories\CourseThematics\CourseThematicsRepositoryInterface;
use App\Repositories\CourseThematicsSource\CourseThematicSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseFreeSourceController extends Controller
{

    protected $pagesRepository;
    protected $courseFreesRepository;
    protected $courseFreeSourceRepository;

    /**
     * PagesController constructor.
     * @param  PagesRepositoryInterface  $pagesRepository
     * @param  CourseFreesRepositoryInterface  $courseFreesRepository
     * @param  CourseFreeSourcesRepositoryInterface  $courseFreeSourceRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseFreesRepositoryInterface $courseFreesRepository,
        CourseFreeSourcesRepositoryInterface $courseFreeSourceRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseFreesRepository = $courseFreesRepository;
        $this->courseFreeSourceRepository = $courseFreeSourceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $request->validate([
            'type' => 'required',
        ], [
            'type.required' => 'Bạn hãy nhập kiểu bài học',
        ]);

        // create source
        try {
            $this->courseFreeSourceRepository->create($param);
            return redirect()->back()->with('status', config('langVN.add_success'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $source = $this->courseFreeSourceRepository->find($id);
        if (!$source) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }
        $param = $request->all();

        // update source
        try {
            $this->courseFreeSourceRepository->update($param, $id);
            return redirect()->back()->with('status', config('langVN.update_success'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return redirect()->back()->with('status', config('langVN.update_failed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->courseFreeSourceRepository->delete($id);
        if ($delete == false) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }
}
