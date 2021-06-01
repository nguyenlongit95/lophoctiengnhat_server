<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CourseFreeQuizs\CourseFreeQuizsRepositoryInterface;
use App\Repositories\CourseFrees\CourseFreesRepositoryInterface;
use App\Repositories\CourseFreeSources\CourseFreeSourcesRepositoryInterface;
use App\Repositories\DocResources\DocResourcesRepositoryInterface;
use App\Repositories\Documentations\DocumentationsRepositoryInterface;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $documentationsRepository;
    private $docResourceRepository;

    public function __construct(
        DocumentationsRepositoryInterface $documentationsRepository,
        DocResourcesRepositoryInterface $docResourceRepository
    )
    {
        $this->documentationsRepository = $documentationsRepository;
        $this->docResourceRepository = $docResourceRepository;
    }

    /**
     * Controller function get all doc and render view documentaion
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $slug)
    {
        $documentations = $this->documentationsRepository->getDocs($slug);
        if (empty($documentations)) {
            return redirect('/');
        }
        return view('frontend.pages.documentation.index', compact('documentations'));
    }
}
