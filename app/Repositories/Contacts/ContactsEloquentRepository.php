<?php

namespace App\Repositories\Contacts;

use App\Models\Contact;
use App\Repositories\Eloquent\EloquentRepository;

class ContactsEloquentRepository extends EloquentRepository implements ContactsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Contact::class;
    }
}
