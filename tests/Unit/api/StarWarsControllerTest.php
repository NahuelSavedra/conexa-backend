<?php

namespace Tests\Unit;

use App\Http\Controllers\api\StarWarsController;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class StarWarsControllerTest extends TestCase
{
    public function testGetPeople()
    {
        Http::fake([
            'https://swapi.dev/api/people*' => Http::response(['results' => ['person1', 'person2']], 200),
        ]);

        $controller = new StarWarsController();

        $response = $controller->getPeople(request());

        $this->assertEquals(['results' => ['person1', 'person2']], $response);
    }

    public function testGetPersonById()
    {
        Http::fake([
            'https://swapi.dev/api/people/1' => Http::response(['name' => 'Luke Skywalker'], 200),
            'https://swapi.dev/api/people/2' => Http::response(['name' => 'Darth Vader'], 200),
        ]);

        $controller = new StarWarsController();

        $response1 = $controller->getPersonById(1);
        $response2 = $controller->getPersonById(2);

        $this->assertEquals(['name' => 'Luke Skywalker'], $response1);
        $this->assertEquals(['name' => 'Darth Vader'], $response2);
    }

    public function testGetApiData()
    {
        Http::fake([
            'https://swapi.dev/api/*' => Http::response(['data'], 200),
        ]);

        $controller = new StarWarsController();

        $response = $controller->getApiData('/test');

        $this->assertEquals(['data'], $response);
    }
}
