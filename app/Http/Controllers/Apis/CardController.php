<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Card;

class CardController extends ApiController
{
    public function __construct(protected Card $model) {}
}
