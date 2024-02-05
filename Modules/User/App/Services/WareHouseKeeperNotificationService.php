<?php

namespace Modules\User\App\Services;

use Modules\Award\App\Models\Award;
use Modules\User\App\Models\User;
use Modules\User\App\Services\V1\Contracts\WareHouseKeeperNotificationContract;

class WareHouseKeeperNotificationService implements WareHouseKeeperNotificationContract
{

    public function toFax(User $user, Award $award): void
    {
        // TODO: Implement toFax() method.
    }

    public function toSms()
    {
        // TODO: Implement toSms() method.
    }
}
