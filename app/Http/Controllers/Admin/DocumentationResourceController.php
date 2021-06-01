<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\DocResources\DocResourcesRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;

class DocumentationResourceController extends Controller
{
    protected $docResourceRepository;

    /**
     * DocumentationResourceController constructor.
     * @param  DocResourcesRepositoryInterface  $docResourcesRepository
     */
    public function __construct(
        DocResourcesRepositoryInterface $docResourcesRepository
    )
    {
        $this->docResourceRepository = $docResourcesRepository;
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
        Validation::validateDocResource($request);

        if ($request->file('url_source') && $request->file('url_source')) {
            $checkFileSound = $this->docResourceRepository->checkFileSource($request);
            $param['url_source'] = $checkFileSound;
        } else {
            return redirect()->back()->with('status', config('langVN.chose_file_sound'));
        }
        $create = $this->docResourceRepository->create($param);
        $param['code'] = md5($param['name'] . '_' . $create->id);
        $this->docResourceRepository->update($param, $create->id);
        if (!$create) {
            return redirect()->back()->with('status', config('langVN.add_failed'));
        }

        return redirect()->back()->with('status', config('langVN.add_success'));
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
        $param = $request->all();
        Validation::validateDocResource($request);

        $quiz = $this->docResourceRepository->find($id);
        if (!$quiz) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }
        if ($request->file('url_source')) {
            $checkFileSource = $this->docResourceRepository->updateFileSource($request);
            $param['url_source'] = $checkFileSource;
        }
        $update = $this->docResourceRepository->update($param, $id);
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
        $source = $this->docResourceRepository->find($id);
        if (!$source) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }

        $delete = $this->docResourceRepository->delete($source->id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }
}
