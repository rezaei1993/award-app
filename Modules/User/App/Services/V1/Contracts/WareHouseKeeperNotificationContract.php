<?php

namespace Modules\User\App\Services\V1\Contracts;

use Modules\Award\App\Models\Award;
use Modules\User\App\Models\User;

interface WareHouseKeeperNotificationContract
{
    public function toFax(User $user, Award $award): void;
    public function toSms();
}
