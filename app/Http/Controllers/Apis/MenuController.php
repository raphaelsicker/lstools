<?php

namespace App\Http\Controllers\Apis;


use App\Http\Controllers\Base\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $menus = [
            [
                'key' => 'home',
                'name' => 'Home',
                'link' => '/',
                'is_menu' => true,
                'default' => 'e',
                'icon' => 'fa fa-home',
            ],
            [
                'key' => 'forms',
                'name' => 'Cadastros',
                'is_menu' => true,
                'default' => 'e',
                'link' => '/forms',
                'icon' => 'fa fa-list',
                'submenus' => [
                    [
                        'key' => 'cities',
                        'name' => 'Cidades',
                        'link' => '/forms/cities',
                        'is_menu' => true,
                        'default' => 'e',
                    ],
                    [
                        'key' => 'ufs',
                        'name' => 'Estados',
                        'link' => '/forms/ufs',
                        'is_menu' => true,
                        'default' => 'e',
                    ],
                    [
                        'key' => 'service-groups',
                        'name' => 'Saídas de Campo',
                        'link' => '/forms/service-groups',
                        'is_menu' => true,
                        'default' => 'e',
                    ],

                ],
            ],
            [
                'key' => 'maps',
                'name' => 'Território',
                'is_menu' => true,
                'default' => 'e',
                'link' => '/maps',
                'icon' => 'fa fa-map',
                'submenus' => [
                    [
                        'key' => 'cards',
                        'name' => 'Cartões',
                        'link' => '/maps/cards',
                        'is_menu' => true,
                        'default' => 'e',
                    ],
                    [
                        'key' => 'Address',
                        'name' => 'Endereços',
                        'link' => '/maps/addresses',
                        'is_menu' => true,
                        'default' => 'e',
                    ],
                ]
            ]
        ];

        return response()->json($menus);
    }
}
