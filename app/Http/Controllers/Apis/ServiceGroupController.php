<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\ServiceGroup;
use App\Models\Uf;

class ServiceGroupController extends ApiController
{
    public function __construct(protected ServiceGroup $model) {}
}
