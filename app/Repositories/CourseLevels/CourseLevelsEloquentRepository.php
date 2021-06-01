<?php

namespace App\Repositories\CourseLevels;

use App\Models\CourseLevelQuizs;
use App\Models\CourseLevelSource;
use App\Models\Pages;
use App\Repositories\Eloquent\EloquentRepository;
use App\Models\CourseLevel;
use Illuminate\Support\Facades\Log;

class CourseLevelsEloquentRepository extends EloquentRepository implements CourseLevelsRepositoryInterface
{
    const SOURCE_PATH_VIDEOS = '/source/videos/course_level/';

    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseLevel::class;
    }

    /**
     * Check for the dependent data of the record
     *
     * @param int $id id of course
     * @return mixed
     */
    public function checkDependentDataSource($id)
    {
        $checkSource = CourseLevelSource::where('course_level_id', $id)->count();
        if ($checkSource > 0) {
            return false;
        }

        $checkQuiz = CourseLevelQuizs::where('course_level_id', $id)->count();
        if ($checkQuiz > 0) {
            return false;
        }

        return true;
    }

    /**
     * Check pages and show description of page
     *
     * @param $slug
     * @return mixed
     */
    public function showPage($slug)
    {
        $page = Pages::where('slug', $slug)->first();

        return $page;
    }

    /**
     * Function get course level of pages
     *
     * @param $page
     * @return mixed
     */
    public function getCourseLevel($page)
    {
        $courseLevels = CourseLevel::where('page_id', $page->id)->where('slug', '<>', null)
            ->orderBy('id', 'DESC')->get();

        return $courseLevels;
    }

    /**
     * Function find an course
     *
     * @param string $course slug of course
     * @return mixed
     */
    public function findCourse($course)
    {
        $courseLevel = CourseLevel::where('slug', $course)->first();

        return $courseLevel;
    }

    /**
     * Function get detail of course
     *
     * @param int $course id a course
     * @return mixed
     */
    public function courseDetail($course)
    {
        $courseLevelSource = CourseLevelSource::where('course_level_id', $course)->get();
        if (empty($courseLevelSource)) {
            return null;
        }

        foreach ($courseLevelSource as $source) {
            $source = $this->decodeInfoSource($source);
        }

        return $courseLevelSource;
    }

    /**
     * Function merge and decode info of resource course
     *
     * @param string $source json info of a source
     * @return mixed
     */
    private function decodeInfoSource($source)
    {
        $info = json_decode($source->info, true);
        $source->drought = $info['drought'];
        $source->chinese = $info['chinese'];
        $source->meaning = $info['meaning'];
        $source->sound_vn = $info['sound_vn'];
        $source->sound_jp = $info['sound_jp'];

        return $source;
    }

    /**
     * Function get all quiz an course
     *
     * @param int $course id a course
     * @return mixed
     */
    public function getQuizOfCourse($course)
    {
        $quiz = CourseLevelQuizs::where('course_level_id', $course)->orderBy('id', 'ASC')->get();

        return $quiz;
    }
}
