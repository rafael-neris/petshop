<?php

namespace App\Repositories;

use App\Models\Pet;

interface PetRepositoryInterface
{
    public function getById(int $id): Pet;
}
