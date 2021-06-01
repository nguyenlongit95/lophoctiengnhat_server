<?php

namespace App\Repositories\CourseOnlineSource;

interface CourseOnlineSourceRepositoryInterface
{
    /**
     * @param $courseOnline
     * @return mixed
     */
    public function listSource($courseOnline);
}
