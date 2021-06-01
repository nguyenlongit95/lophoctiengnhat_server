<?php


namespace App\Repositories\Pages;

use App\Models\Pages;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\Pages\PagesRepositoryInterface;

class PagesEloquentRepository extends EloquentRepository implements PagesRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return Pages::class;
    }

    /**
     * Function check course of Page here
     *
     * @param $page
     * @return mixed
     */
    public function checkCourse($page)
    {
        if (count($page->courseOnline) > 0) {
            return false;
        }

        return true;
    }
}
