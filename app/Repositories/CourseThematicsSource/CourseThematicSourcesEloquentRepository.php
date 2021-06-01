<?php

namespace App\Repositories\CourseThematicsSource;

use App\Models\CourseThematicSources;
use App\Repositories\CourseLevelSources\CourseLevelSourcesRepositoryInterface;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class CourseThematicSourcesEloquentRepository extends EloquentRepository implements CourseThematicSourcesRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseThematicSources::class;
    }

    /**
     * @param $course
     * @return mixed
     */
    public function getSource($course)
    {
        $source = $this->_model->where('course_thematic_id', $course->id)->orderBy('id', 'ASC')->get();

        return $source;
    }

    /**
     * Function list all word of lesson
     *
     * @param int $idSource of source
     * @return mixed
     */
    public function getWordOfLesson($idSource)
    {
        $word = DB::table('course_thematic_sources_work')->where('course_thematic_sources_id', $idSource)
            ->orderBy('id', 'ASC')->get();

        return $word;
    }

    /**
     * Function update word of lesson
     *
     * @param array $param
     * @param $request
     * @return mixed
     */
    public function updateWord($param, $request)
    {
        $arrAttr = [
            'source' => $param['source'],
            'drought' => $param['drought'],
            'chinese' => $param['chinese'],
            'meaning' => $param['meaning'],
        ];
        try {
            if (isset($param['sound_vn'])) {
                if ($request->hasFile('sound_vn')) {
                    $updateFileSound = app()->make(CourseLevelSourcesRepositoryInterface::class)->updateFileSound($request, 'vn');
                    $arrAttr['sound_vn'] = $updateFileSound['sound_vn'];
                }
            }
            if (isset($param['sound_jp'])) {
                if ($request->hasFile('sound_jp')) {
                    $updateFileSound = app()->make(CourseLevelSourcesRepositoryInterface::class)->updateFileSound($request, 'jp');
                    $arrAttr['sound_jp'] = $updateFileSound['sound_jp'];
                }
            }

            return DB::table('course_thematic_sources_work')->where('id', $param['id'])->update($arrAttr);
        } catch (\Exception $exception) {
            \Log::error($exception);
            return false;
        }
    }

    /**
     * Function add word and move file sound to storage
     *
     * @param array $param
     * @param $request
     * @return mixed
     */
    public function wordAdd($param, $request)
    {
        try {
            $moveFile = app()->make(CourseLevelSourcesRepositoryInterface::class)->checkFileSound($request);
            if (is_array($moveFile)) {
                return DB::table('course_thematic_sources_work')->insert([
                    'course_thematic_sources_id' => $param['course_thematic_sources_id'],
                    'source' => $param['source'],
                    'drought' => $param['drought'],
                    'chinese' => $param['chinese'],
                    'meaning' => $param['meaning'],
                    'sound_vn' => $moveFile['sound_vn'],
                    'sound_jp' => $moveFile['sound_jp'],
                ]);
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            return false;
        }
    }

    /**
     * Function delete an word of course thematic
     *
     * @param int $id of word
     * @return int
     */
    public function deleteWord($id)
    {
        return DB::table('course_thematic_sources_work')->where('id', $id)->delete();
    }

    /**
     * Function get source using slug of lesson
     *
     * @param $slug
     * @return mixed
     */
    public function getSourceUsingSlug($slug)
    {
        $source = $this->_model->where('slug', $slug)->first();

        return $source;
    }
}
