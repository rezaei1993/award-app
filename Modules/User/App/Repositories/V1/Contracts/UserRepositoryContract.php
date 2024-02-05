<?php

namespace Modules\User\App\Repositories\V1\Contracts;

use Modules\Award\App\Models\Award;
use Modules\User\App\Models\User;

interface UserRepositoryContract
{
    public function getWarehouseKeeper(): User;
    public function getRandomUser(): User;
    public function decrementPoint(User $user): User;
    public function getAuthenticatedUser(): User;
    public function assignAwardToUser(User $user, Award $award): null;
}
