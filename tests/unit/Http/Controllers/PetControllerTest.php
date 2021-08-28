<?php

namespace unit\Http\Controllers;

use App\Http\Controllers\PetController;
use App\Models\Pet;
use App\Services\PetService;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class PetControllerTest extends \TestCase
{
    private PetController $petController;
    private PetService $petService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->petService = $this->getMockBuilder(PetService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->petController = new PetController($this->petService);
    }

    public function testShouldReturnPetById()
    {
        $petReturn = new Pet();
        $petReturn->name = 'Teste';
        $this->petService->method('getById')->willReturn($petReturn);

        // Act
        $return = $this->petController->show(1);

        // Assert
        $returnArray = json_decode($return->getContent(), true);
        $this->assertInstanceOf(JsonResponse::class, $return);
        $this->assertJson($return->getContent());
        $this->assertEquals('Teste', $returnArray['name']);
    }

    public function testShouldNotReturnPetById()
    {
        // Arrange
        $petReturn = new Pet();
        $petReturn->name = 'Teste';
        $this->petService->method('getById')->willThrowException(new ModelNotFoundException());


        $return = $this->petController->show(1);


        $returnArray = json_decode($return->getContent(), true);
        $this->assertInstanceOf(JsonResponse::class, $return);
        $this->assertJson($return->getContent());
        $this->assertEquals(StatusCodeInterface::STATUS_NOT_FOUND, $return->getStatusCode());
        $this->assertEquals([
            'mensagem' => 'Recurso não encontrado'
        ], $returnArray);
    }
}
