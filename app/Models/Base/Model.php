<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 * @method static count()
 */
abstract class Model extends \Illuminate\Database\Eloquent\Model
{

}
