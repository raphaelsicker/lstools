<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Uf;

class UfController extends ApiController
{
    public function __construct(protected Uf $model) {}
}
