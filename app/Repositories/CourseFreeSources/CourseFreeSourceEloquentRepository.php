<?php

namespace App\Repositories\CourseFreeSources;

use App\Models\CourseFreeSources;
use App\Repositories\Eloquent\EloquentRepository;

class CourseFreeSourceEloquentRepository extends EloquentRepository implements CourseFreeSourcesRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseFreeSources::class;
    }

    /**
     * @param $course
     * @return mixed
     */
    public function getSource($course)
    {
        $source = $this->_model->where('course_free_id', $course->id)->orderBy('id', 'ASC')->get();

        return $source;
    }
}
