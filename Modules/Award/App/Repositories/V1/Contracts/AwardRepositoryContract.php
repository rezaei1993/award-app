<?php

namespace Modules\Award\App\Repositories\V1\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Award\App\Models\Award;

interface AwardRepositoryContract
{
    public function getAll(): Collection;
    public function getAvailableAwards(): Collection;
    public function getById(int $id): Award;
    public function decrementInventory(Award $award): Award;

}
