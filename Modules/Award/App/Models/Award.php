<?php

namespace Modules\Award\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Award\Database\Factories\AwardFactory;
use Modules\User\App\Models\User;

/**
 * @property int $id
 * @property string $title
 * @property int $coefficient
 * @property int $inventory
 */

class Award extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'coefficient', 'inventory'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'award_user')
            ->withPivot('time');
    }

    public function isEmpty(): bool
    {
        return $this->title == 'Empty';
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    protected static function newFactory(): AwardFactory
    {
        return AwardFactory::new();
    }
}
