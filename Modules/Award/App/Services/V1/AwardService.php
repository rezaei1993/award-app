<?php

namespace Modules\Award\App\Services\V1;

use Modules\Award\App\Exceptions\EmptyInventoryException;
use Modules\Award\App\Exceptions\InsufficientUserPointException;
use Modules\Award\App\Models\Award;
use Modules\Award\App\Repositories\V1\Contracts\AwardRepositoryContract;
use Modules\Award\App\Services\V1\Contracts\AwardServiceContract;
use Modules\User\App\Models\User;
use Modules\User\App\Repositories\V1\Contracts\UserRepositoryContract;
use Modules\User\App\Services\V1\Contracts\WareHouseKeeperNotificationContract;
use Throwable;

class AwardService implements AwardServiceContract
{
    public function __construct(private readonly UserRepositoryContract  $userRepositoryContract,
                                private readonly AwardRepositoryContract $awardRepositoryContract,
                                private readonly WareHouseKeeperNotificationContract $wareHouseKeeperNotificationContract,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function luckyWheel(): Award
    {
        $authenticatedUser = $this->userRepositoryContract->getAuthenticatedUser();
        $this->checkUserPoint($authenticatedUser);
        $selectedAward = $this->doWheel();

        if ($selectedAward->isNotEmpty()) {
            $this->checkAwardInventory($selectedAward);
            $this->userRepositoryContract->assignAwardToUser($authenticatedUser, $selectedAward);
            $this->userRepositoryContract->decrementPoint($authenticatedUser);
            $this->awardRepositoryContract->decrementInventory($selectedAward);
            $this->sendNotificationToWareHouseKeeper($selectedAward);
        }

        return $selectedAward;
    }

    public function doWheel(): Award
    {
        $awards = $this->awardRepositoryContract->getAll();
        $selectedAwardId = $this->getRandomAwardId($awards);
        return $this->awardRepositoryContract->getById($selectedAwardId);
    }


    /**
     * @throws Throwable
     */
    public function checkAwardInventory(Award $selectedAward): void
    {
        throw_if($selectedAward->inventory <= 0, new EmptyInventoryException());
    }

    /**
     * @throws Throwable
     */
    public function checkUserPoint(User $authenticatedUser): void
    {
        throw_if($authenticatedUser->point <= config('award.points_to_deduct'), new InsufficientUserPointException());
    }

    public function sendNotificationToWareHouseKeeper(Award $selectedAward): void
    {
        $wareHouseKeeper = $this->userRepositoryContract->getWarehouseKeeper();
        $this->wareHouseKeeperNotificationContract->toFax($wareHouseKeeper, $selectedAward);
    }


    public function getRandomAwardId($awards)
    {
        $probabilities = [];
        foreach ($awards as $award) {
            for ($i = 1; $i <= $award->coefficient; $i++) {
                $probabilities[] = $award->id;
            }
        }

        shuffle($probabilities);
        $randomIndex = array_rand($probabilities);
        return $probabilities[$randomIndex];
    }
}
