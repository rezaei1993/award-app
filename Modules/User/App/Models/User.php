<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Award\App\Models\Award;
use Modules\User\Database\factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $point
 */

class User extends Authenticatable
{
    use HasFactory;

    public const DEFAULT_POINT = 100;


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'user', 'point'];

    public function awards()
    {
        return $this->belongsToMany(Award::class, 'award_user')
            ->withPivot('time');
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
