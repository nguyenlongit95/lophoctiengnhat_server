<?php

namespace App\Repositories\CourseLevelSources;

use App\Models\CourseLevelQuizs;
use App\Models\CourseLevelSource;
use App\Repositories\Eloquent\EloquentRepository;
use phpDocumentor\Reflection\Type;

class CourseLevelSourcesEloquentRepository extends EloquentRepository implements CourseLevelSourcesRepositoryInterface
{
    const SOURCE_PATH_SOUND = '/source/sound/';

    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseLevelSource::class;
    }

    /**
     * Function check file sound and return path of file
     *
     * @param $request
     * @return array
     */
    public function checkFileSound($request)
    {
        $arrSoundPath = array();
        // Check file sound vietnam
        if ($request->file('sound_vn')->getClientOriginalExtension() == 'mp3' || $request->file('sound_vn')->getClientOriginalExtension() == 'wma') {
            if ($request->file('sound_vn')->getSize() > config('const.max_file_size')) {
                return config('langVN.err_brand_file');
            }
            $arrSoundPath['sound_vn'] = self::SOURCE_PATH_SOUND . $request->file('sound_vn')->getClientOriginalName();
            $request->file('sound_vn')->move(self::SOURCE_PATH_SOUND, $request->file('sound_vn')->getClientOriginalName());
        } else {
            return config('langVN.err_Extension');
        }
        // check file sound japan
        if ($request->file('sound_jp')->getClientOriginalExtension() == 'mp3' || $request->file('sound_jp')->getClientOriginalExtension() == 'wma') {
            if ($request->file('sound_jp')->getSize() > config('const.max_file_size')) {
                return config('langVN.err_brand_file');
            }
            $arrSoundPath['sound_jp'] = self::SOURCE_PATH_SOUND . $request->file('sound_jp')->getClientOriginalName();
            $request->file('sound_jp')->move(self::SOURCE_PATH_SOUND, $request->file('sound_jp')->getClientOriginalName());
        } else {
            return config('langVN.err_Extension');
        }

        return $arrSoundPath;
    }

    /**
     * Function get all source of course
     *
     * @param $course
     * @return mixed
     */
    public function getSource($course)
    {
        $source = $this->_model->where('course_level_id', $course->id)->orderBy('id', 'ASC')->get();

        return $source;
    }

    /**
     * Function parse info of source
     *
     * @param $sources
     * @return mixed
     */
    public function parseDataSource($sources)
    {
        if (!empty($sources)) {
            foreach ($sources as $source) {
                $data = json_decode($source->info, true);
                $source->drought = $data['drought'];
                $source->chinese = $data['chinese'];
                $source->meaning = $data['meaning'];
                $source->sound_vn = $data['sound_vn'];
                $source->sound_jp = $data['sound_jp'];
            }
        }

        return $sources;
    }

    /**
     * Function check update file sound
     *
     *  User update 1 in 2 file sound or update 2 file sound
     * @param $request
     * @param $type
     * @return mixed
     */
    public function updateFileSound($request, $type)
    {
        if ($type == 'vn') {
            if ($request->file('sound_vn')->getClientOriginalExtension() == 'mp3' || $request->file('sound_vn')->getClientOriginalExtension() == 'wma') {
                if ($request->file('sound_vn')->getSize() > config('const.max_file_size')) {
                    return config('langVN.err_brand_file');
                }
                $arrSoundPath['sound_vn'] = self::SOURCE_PATH_SOUND . $request->file('sound_vn')->getClientOriginalName();
                $request->file('sound_vn')->move(self::SOURCE_PATH_SOUND, $request->file('sound_vn')->getClientOriginalName());
                return [
                    'sound_vn' => $arrSoundPath['sound_vn']
                ];
            } else {
                return config('langVN.err_Extension');
            }
        } else {
            // check file sound japan
            if ($request->file('sound_jp')->getClientOriginalExtension() == 'mp3' || $request->file('sound_jp')->getClientOriginalExtension() == 'wma') {
                if ($request->file('sound_jp')->getSize() > config('const.max_file_size')) {
                    return config('langVN.err_brand_file');
                }
                $arrSoundPath['sound_jp'] = self::SOURCE_PATH_SOUND . $request->file('sound_jp')->getClientOriginalName();
                $request->file('sound_jp')->move(self::SOURCE_PATH_SOUND, $request->file('sound_jp')->getClientOriginalName());
                return [
                    'sound_jp' => $arrSoundPath['sound_jp']
                ];
            } else {
                return config('langVN.err_Extension');
            }
        }
    }

    /**
     * Function delete file sound after destroy an source
     *
     * @param $src
     * @return mixed|void
     */
    public function deleteFileSound($src)
    {
        if ($src == null) {
            return false;
        }

        if (!file_exists(asset($src))) {
            return false;
        }

        return true;
    }
}
