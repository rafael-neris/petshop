<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OwnersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLookingForRegisteredOwners()
    {
        $response = $this->call('GET', '/api/owners');

        $this->assertEquals(200, $response->status());
    }

    public function testCreatingAnOwner()
    {
        $response = $this->call('POST', '/api/owners', ['name' => 'Jose','cellphone' => '(11) 11111-1111']);

        $this->assertEquals(201, $response->status());
    }

    public function testUpdatingAnOwner()
    {
        $response = $this->call('PUT', '/api/owners/3', ['name' => 'Jose','cellphone' => '(11) 11111-1111']);

        $this->assertEquals(200, $response->status());
    }

    public function testTryingToUpdateAnOwnerThatDoesNotExist()
    {
        $response = $this->call('PUT', '/api/owners/28', ['name' => 'Jose','cellphone' => '(11) 11111-1111']);

        $this->assertEquals(404, $response->status());
    }
}
