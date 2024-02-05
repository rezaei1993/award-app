<?php

namespace Modules\Award\App\Repositories\V1\Mysql;

use Illuminate\Database\Eloquent\Collection;
use Modules\Award\App\Models\Award;
use Modules\Award\App\Repositories\V1\Contracts\AwardRepositoryContract;

class AwardMysqlRepository implements AwardRepositoryContract
{
    public function getAll(): Collection
    {
        return Award::all();
    }

    public function getAvailableAwards(): Collection
    {
        return Award::where('inventory', '>' ,0)->get();
    }

    public function decrementInventory(Award $award): Award
    {
        return tap($award)->decrement('inventory');
    }

    public function getById($id): Award
    {
        return Award::lockForUpdate()->find($id);
    }
}
