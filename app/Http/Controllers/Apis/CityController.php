<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\City;

class CityController extends ApiController
{
    public function __construct(protected City $model) {}
}
