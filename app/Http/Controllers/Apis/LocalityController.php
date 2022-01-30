<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Locality;

class LocalityController extends ApiController
{
    public function __construct(protected Locality $model) {}
}
