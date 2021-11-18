<?php

namespace App\Models;

use App\Models\Traits\HasStandardTimestamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends ModelAbstract
{
    use SoftDeletes, HasStandardTimestamps;
}
