<?php

namespace App\Services;

use App\Repositories\PetRepositoryInterface;

class PetService
{
    private PetRepositoryInterface $petRepository;

    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    public function getById(int $id)
    {
        return $this->petRepository->getById($id);
    }
}
