<?php

namespace Modules\Award\App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AwardUser extends Pivot
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'award_id', 'time'];
    protected $table = 'award_user';
}
