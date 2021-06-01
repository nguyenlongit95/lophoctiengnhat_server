<?php

namespace App\Repositories\Vocabularies;

use App\Models\Vocabularies;
use App\Repositories\Eloquent\EloquentRepository;

class VocabulariesEloquentRepository extends EloquentRepository implements VocabulariesRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Vocabularies::class;
    }
}
