<?php

namespace App\Http\Controllers;

use App\Http\Resources\NeaResource;

class NeaController extends Controller

{
    public static $neas = array(
        [
            'id' => 1,
            'name' => 'Simon',
            'height' => '1.82',
            'skill' => 'tomar guaro',
            'image' => 'https://pbs.twimg.com/profile_images/1523161795011227649/onAcwpgp_400x400.jpg',
            'phrase' => 'Por más alto que vuele el gallinazo en algún momento le toca bajar a comer mierda',
        ],
        [
            'id' => 2,
            'name' => 'Ryan Castro',
            'height' => '1.75',
            'skill' => 'cantar',
            'image' => 'https://starktimes.com/wp-content/webp-express/webp-images/uploads/2022/02/Ryan-Castro-1.jpg.webp',
            'phrase' => 'Qué chimba SOG',
        ],
        [
            'id' => 3,
            'name' => 'Ferxxo',
            'height' => '1.70',
            'skill' => 'tramar bandidas',
            'image' => 'https://cdns-images.dzcdn.net/images/artist/d3c0b6e0ac02c2f74203b2d5c5507240/500x500.jpg',
            'phrase' => 'Así como suena',
        ],
        [
            'id' => 4,
            'name' => 'Fico',
            'height' => '1.72',
            'skill' => 'carisma',
            'image' => 'https://pbs.twimg.com/media/FQmDt-iXEAAJ8Y5?format=jpg&name=large',
            'phrase' => 'No se ofusque',
        ],
        [
            'id' => 5,
            'name' => 'Hincha de Santa Fe',
            'height' => '1.70',
            'skill' => 'pasar corriente',
            'image' => 'https://www.publimetro.co/resizer/tWlcgUFbvRv5IpPAE9Ftv1XyetY=/1440x810/filters:format(jpg):quality(70)/cloudfront-us-east-1.images.arcpublishing.com/metroworldnews/HKZDXL2VQVHVBJBGXKV26GHZNQ.jpg',
            'phrase' => 'Péguelo, péguelo',
        ],
        [
            'id' => 6,
            'name' => 'La Liendra',
            'height' => '1.74',
            'skill' => 'dar visaje',
            'image' => 'https://www.las2orillas.co/wp-content/uploads/2020/08/la-liendra.jpg',
            'phrase' => 'Hola liendritas',
        ],
        [
            'id' => 7,
            'name' => 'Papi Juancho',
            'height' => '1.76',
            'skill' => 'ser pinta y talentoso',
            'image' => 'https://www.qhubomedellin.com/wp-content/uploads/2021/08/Juan-Luis-Londono-Maluma.jpg',
            'phrase' => 'Hawai de vacaciones, mis felicitaciones',
        ]

    );

    public function findAll()
    {
        return response()->json([
            'data' => NeaResource::collection(NeaController::$neas),
            'meta' => [
                'api_version' => '1.0.0',
                'ip' => $_SERVER['REMOTE_ADDR'],
                'docker_container' => gethostbyname(gethostname()),
            ],
        ]);
    }

    public function find($id)
    {
        // get the pokenea with the specified id from values of the static array
        $nea = array_filter(NeaController::$neas, function ($nea) use ($id) {
            return $nea['id'] == $id;
        });
        $nea = array_values($nea)[0];

        return response()->json([
            'data' => NeaResource::collection($nea),
            'meta' => [
                'api_version' => '1.0.0',
                'ip' => $_SERVER['REMOTE_ADDR'],
                'docker_container' => gethostbyname(gethostname()),
            ],
        ]);
    }

    public function getRandom()
    {
        $neaIndex = array_rand(NeaController::$neas);

        return response()->json([
            'data' => NeaController::$neas[$neaIndex],
            'meta' => [
                'api_version' => '1.0.0',
                'ip' => $_SERVER['REMOTE_ADDR'],
                'docker_container' => gethostbyname(gethostname()),
            ],
        ]);
    }

    public function getRandomWithView()
    {
        $neaIndex = array_rand(NeaController::$neas);

        $viewData = [
            'nea' => NeaController::$neas[$neaIndex],
            'docker_container' => gethostbyname(gethostname()),
        ];

        return view('nea.show', $viewData);
    }
}
