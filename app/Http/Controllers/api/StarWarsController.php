<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StarWarsController extends Controller
{
    const URL_API = 'https://swapi.dev/api';

    public function getPeople(Request $request)
    {
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $uri = "/people?limit={$limit}&offset={$offset}";

        return $this->getApiData($uri);
    }

    public function getPersonById($id)
    {
        $uri = "/people/$id";

        return $this->getApiData($uri);
    }

    public function getPlanets(Request $request)
    {
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $uri = "/planets/?limit=$limit&offset=$offset";

        return $this->getApiData($uri);
    }

    public function getPlanetById($id)
    {
        $uri = "/planets/$id";

        return $this->getApiData($uri);

    }

    public function getVehicles(Request $request)
    {
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $uri = "/vehicles/?limit=$limit&offset=$offset";
        return $this->getApiData($uri);

    }

    public function getVehicleById($id)
    {
        $uri = "/vehicles/$id";

        return $this->getApiData($uri);
    }

    /**
     * @param string $uri
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getApiData(string $uri)
    {
        try {
            $response = Http::get(self::URL_API . $uri);

            $response->throw();
            return $response->json();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
