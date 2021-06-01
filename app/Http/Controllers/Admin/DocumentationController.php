<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DocResources\DocResourcesRepositoryInterface;
use App\Repositories\Documentations\DocumentationsRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    protected $pagesRepository;
    protected $documentationsRepository;
    protected $docResourcesRepository;

    /**
     * DocumentationController constructor.
     * @param  DocumentationsRepositoryInterface  $documentationsRepository
     * @param  DocResourcesRepositoryInterface  $docResourcesRepository
     */
    public function __construct(
        DocumentationsRepositoryInterface $documentationsRepository,
        DocResourcesRepositoryInterface $docResourcesRepository
    )
    {
        $this->documentationsRepository = $documentationsRepository;
        $this->docResourcesRepository = $docResourcesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentations = $this->documentationsRepository->getAll(config('const.paginate'), 'DESC');
        return view('admin.pages.documentation.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.documentation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validateDocumentation($request);

        $param = $request->all();
        $param['code'] = md5($param['slug']);

        $store = $this->documentationsRepository->create($param);
        if ($store) {
            return redirect('/admin/documentation/index')->with('status', config('langVN.add_success'));
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
        $documentation = $this->documentationsRepository->find($id);
        if (!$documentation) {
            return redirect('/admin/documentation/index')->with('status', config('langVN.data_not_found'));
        }
        $docResources = $this->docResourcesRepository->getDocumentation($documentation);

        return view('admin.pages.documentation.edit', compact('documentation', 'docResources'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->documentationsRepository->find($id);
        if (!$course) {
            return redirect('/admin/documentation/index')->with('status', config('langVN.data_not_found'));
        }

        $checkDependentData = $this->documentationsRepository->checkDependentDataSource($course->id);
        if ($checkDependentData == false) {
            return redirect('/admin/documentation/index')->with('status', config('langVN.delete_failed_data_collect'));
        }

        $delete = $this->documentationsRepository->delete($id);
        if ($delete == true) {
            return redirect('/admin/documentation/index')->with('status', config('langVN.delete_success'));
        }
    }
}
