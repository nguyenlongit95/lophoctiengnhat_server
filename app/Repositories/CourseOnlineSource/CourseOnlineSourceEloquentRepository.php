<?php


namespace App\Repositories\CourseOnlineSource;


use App\Models\CourseOnlineSource;
use App\Repositories\Eloquent\EloquentRepository;

class CourseOnlineSourceEloquentRepository extends EloquentRepository implements CourseOnlineSourceRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CourseOnlineSource::class;
    }

    /**
     * SQL function Get all the resources of the online lesson
     *
     * @param $courseOnline
     * @return mixed
     */
    public function listSource($courseOnline)
    {
        return $this->_model->where('course_online_id', $courseOnline->id)
            ->orderBy('sort', 'ASC')->paginate(config('const.paginate'));
    }
}
