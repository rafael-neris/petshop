<?php

namespace App\Repositories;

use App\Models\Pet;

class PetRepository implements PetRepositoryInterface
{
    public function getById(int $id): Pet
    {
        return Pet::findOrFail($id);
    }
}
