<?php

namespace App\Repositories\NewCurriculums;

use App\Models\NewCurriculums;
use App\Repositories\Eloquent\EloquentRepository;

class NewCurriculumsEloquentRepository extends EloquentRepository implements NewCurriculumsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return NewCurriculums::class;
    }

    public function getCurriulum($slug)
    {
        return $this->_model->where('slug', $slug)->first();
    }
}
