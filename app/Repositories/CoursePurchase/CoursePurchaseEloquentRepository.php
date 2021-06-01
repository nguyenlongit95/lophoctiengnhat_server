<?php

namespace App\Repositories\CoursePurchase;

use App\Models\CoursePurchase;
use App\Repositories\Eloquent\EloquentRepository;

class CoursePurchaseEloquentRepository extends EloquentRepository implements CoursePurchaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CoursePurchase::class;
    }
}
