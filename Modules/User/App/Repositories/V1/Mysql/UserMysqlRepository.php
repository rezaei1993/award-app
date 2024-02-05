<?php

namespace Modules\User\App\Repositories\V1\Mysql;

use Modules\Award\App\Models\Award;
use Modules\User\App\Models\User;
use Modules\User\App\Repositories\V1\Contracts\UserRepositoryContract;

class UserMysqlRepository implements UserRepositoryContract
{

    public function getRandomUser(): User
    {
       return User::inRandomOrder()->first();
    }

    public function getAuthenticatedUser(): User
    {
        return  auth()->user();
    }

    public function decrementPoint(User $user): User
    {
        return tap($user)->decrement('point', config('award.points_to_deduct'));
    }
    public function assignAwardToUser(User $user, Award $award): null
    {
        return $user->awards()->attach($award);
    }

    public function getWarehouseKeeper(): User
    {
        return User::first();
    }
}
