<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends ApiController
{
    public function __construct(
        protected Card $model,
        private CardService $cardService
    ) {}

    public function toPrint(Request $request)
    {
        if($response = $this->cardService->toPrint($request->all())) {
            return response()->json($response);
        }

        return response()->json([
            'message' => 'Erro ao salvar o registro'
        ], 500);
    }
}
