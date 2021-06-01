<?php

namespace App\Repositories\CourseThematics;
use App\Models\CourseLevelQuizs;
use App\Models\CourseLevelSource;
use App\Models\CourseThematics;

use App\Models\CourseThematicSources;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\Log;

class CourseThematicsEloquentRepository extends EloquentRepository implements CourseThematicsRepositoryInterface
{
    const SOURCE_PATH_VIDEOS = '/source/videos/course_thematic/';

    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseThematics::class;
    }

    /**
     * Check for the dependent data of the record
     * @param int $id
     * @return bool
     */
    public function checkDependentDataSource($id)
    {
        $checkSource = CourseThematicSources::where('course_thematic_id', $id)->count();
        if ($checkSource > 0) {
            return false;
        }

        return true;
    }

    /**
     * Function get course thematic using slug of course
     *
     * @param string $slug
     * @return mixed
     */
    public function getCourseUsingSlug($slug)
    {
        $course = CourseThematics::where('slug', $slug)->first();

        return $course;
    }
}
