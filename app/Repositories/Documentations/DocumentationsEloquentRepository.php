<?php

namespace App\Repositories\Documentations;

use App\Models\Documentations;
use App\Repositories\Eloquent\EloquentRepository;

class DocumentationsEloquentRepository extends EloquentRepository implements DocumentationsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Documentations::class;
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkDependentDataSource($id)
    {
        $checkSource = DocResource::where('doc_id', $id)->count();
        if ($checkSource > 0) {
            return false;
        }

        return true;
    }

    /**
     * SQL function get an documentation and relation ship
     *
     * @param string $slug of document
     * @return mixed
     */
    public function getDocs($slug)
    {
        return $this->_model->where('slug', $slug)->with('docResource')->first();
    }
}
