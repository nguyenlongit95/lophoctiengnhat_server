<?php

namespace App\Repositories\Pages;

interface PagesRepositoryInterface
{
    /**
     * @param $page
     * @return mixed
     */
    public function checkCourse($page);
}
