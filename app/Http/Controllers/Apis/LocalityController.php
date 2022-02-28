<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Address;
use App\Models\Card;
use App\Models\Locality;
use App\Services\LocalityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocalityController extends ApiController
{
    public function __construct(
        protected Locality $model,
        private LocalityService $localityService
    ) {}

    public function cards(int $id): JsonResponse
    {
        $cards = $this->model
            ->find($id)
            ->cards(false)
            ->with(['addresses'])
            ->get();

        return response()->json($cards);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $locality = $request->all();

        if($response = $this->localityService->save($locality, $id)) {
            return response()->json($response);
        }

        return response()->json([
            'message' => 'Erro ao salvar o registro'
        ], 500);
    }
}
