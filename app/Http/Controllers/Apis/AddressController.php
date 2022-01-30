<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Base\ApiController;
use App\Models\Address;

class AddressController extends ApiController
{
    public function __construct(protected Address $model) {}
}
