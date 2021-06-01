<?php

namespace App\Repositories\Reviews;

use App\Models\Reviews;
use App\Repositories\Eloquent\EloquentRepository;

class ReviewsEloquentRepository extends EloquentRepository implements ReviewsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Reviews::class;
    }
}
