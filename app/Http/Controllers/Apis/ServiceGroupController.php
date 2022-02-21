<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\ServiceGroup;
use Illuminate\Http\JsonResponse;

class ServiceGroupController extends ApiController
{
    public function __construct(protected ServiceGroup $model) {}

    public function localities(int $id): JsonResponse
    {
        $localities = $this->model
            ->find($id)
            ->localities;

        return response()->json($localities);
    }
}
