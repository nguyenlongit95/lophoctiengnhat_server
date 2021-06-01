<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseLevels\CourseLevelsRepositoryInterface;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseLevelSourceController extends Controller
{
    protected $pagesRepository;
    protected $courseRepository;
    protected $courseLevelSourceRepository;

    /**
     * PagesController constructor.
     * @param PagesRepositoryInterface $pagesRepository
     * @param CourseLevelsRepositoryInterface $courseRepository
     * @param CourseLevelSourcesRepositoryInterface $courseLevelSourceRepository
     */
    public function __construct(
        PagesRepositoryInterface $pagesRepository,
        CourseLevelsRepositoryInterface $courseRepository,
        CourseLevelSourcesRepositoryInterface $courseLevelSourceRepository
    ) {
        $this->pagesRepository = $pagesRepository;
        $this->courseRepository = $courseRepository;
        $this->courseLevelSourceRepository = $courseLevelSourceRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validation::validateCourseLevelSource($request);
        $param = $request->all();
        $request->validate([
            'source' => 'required',
            'drought' => 'required',
            'chinese' => 'required',
            'meaning' => 'required'
        ], [
            'source.required' => 'Bạn hãy nhập mục từ',
            'drought.required' => 'Hãy nhập Hán tự',
            'chinese.required' => 'Hãy nhập âm Hán',
            'meaning.required' => 'Nhập ý nghĩa của từ',
        ]);

        $soundPath = [
            'sound_vn' => '',
            'sound_jp' => '',
        ];
        if ($request->file('sound_vn') && $request->file('sound_jp')) {
            $checkFileSound = $this->courseLevelSourceRepository->checkFileSound($request);
            if (!is_array($checkFileSound)) {
                return redirect()->back()->with('status', $checkFileSound);
            }
            $soundPath = $checkFileSound;
        } else {
            return redirect()->back()->with('status', config('langVN.chose_file_sound'));
        }

        $info = [
            'drought' => $param['drought'],
            'chinese' => $param['chinese'],
            'meaning' => $param['meaning'],
            'sound_vn' => $soundPath['sound_vn'],
            'sound_jp' => $soundPath['sound_jp'],
        ];
        $param['info'] = json_encode($info);

        // create source
        try {
            $this->courseLevelSourceRepository->create($param);
            return redirect()->back()->with('status', config('langVN.add_success'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return redirect()->back()->with('status', config('langVN.add_failed'));
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
        Validation::validateCourseLevelSource($request);
        $source = $this->courseLevelSourceRepository->find($id);
        if (!$source) {
            return redirect()->with('status', config('langVN.data_not_found'));
        }
        $param = $request->all();
        $soundPath['sound_vn'] = $source->sound_vn;
        $soundPath['sound_jp'] = $source->sound_jp;
        if ($request->file('sound_vn')) {
            $checkFileSound = $this->courseLevelSourceRepository->updateFileSound($request, 'vn');
            if (!is_array($checkFileSound)) {
                return redirect()->back()->with('status', $checkFileSound);
            }
            $soundPath['sound_vn'] = $checkFileSound['sound_vn'];
        }
        if ($request->file('sound_jp')) {
            $checkFileSound = $this->courseLevelSourceRepository->updateFileSound($request, 'jp');
            if (!is_array($checkFileSound)) {
                return redirect()->back()->with('status', $checkFileSound);
            }
            $soundPath['sound_jp'] = $checkFileSound['sound_jp'];
        }

        $info = [
            'drought' => $param['drought'],
            'chinese' => $param['chinese'],
            'meaning' => $param['meaning'],
            'sound_vn' => $soundPath['sound_vn'],
            'sound_jp' => $soundPath['sound_jp'],
        ];
        $param['info'] = json_encode($info);

        // update source
        try {
            $this->courseLevelSourceRepository->update($param, $id);
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
        $source = $this->courseLevelSourceRepository->find($id);
        if (!$source) {
            return redirect()->back()->with('status', config('langVN.data_not_found'));
        }

        $delete = $this->courseLevelSourceRepository->delete($source->id);
        if (!$delete) {
            return redirect()->back()->with('status', config('langVN.delete_failed'));
        }

        return redirect()->back()->with('status', config('langVN.delete_success'));
    }
}
