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
            'chave' => 'home',
            'name' => 'Home',
            'pai' => '',
            'link' => '/',
            'exibir_no_menu' => true,
            'padrao' => 'e',
            'icon' => 'fa fa-home',
        ];

        return response()->json([$menus]);
    }
}