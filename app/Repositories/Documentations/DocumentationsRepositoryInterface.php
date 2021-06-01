<?php

namespace App\Repositories\Documentations;

interface DocumentationsRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function checkDependentDataSource($id);
    public function getDocs($slug);
}
