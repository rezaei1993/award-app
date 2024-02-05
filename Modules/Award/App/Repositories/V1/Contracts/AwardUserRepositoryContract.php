<?php

namespace Modules\Award\App\Repositories\V1\Contracts;

use Modules\Award\App\Models\Award;
use Modules\User\App\Models\User;

interface AwardUserRepositoryContract
{
    public function create(User $user, Award $awards);
}
