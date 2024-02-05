<?php

namespace Modules\Award\App\Http\Controllers\V1\Front;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Award\App\resources\AwardResource;
use Modules\Award\App\Services\V1\Contracts\AwardServiceContract;

class AwardController extends Controller
{
    protected Response $response;
    public function __construct(private readonly AwardServiceContract $awardServiceContract,
                                Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     * @test path('/Modules\Award\tests\Feature\V1\Front\AwardTest.php')
     */
    public function __invoke()
    {
        try {
            DB::beginTransaction();
            $selectedAward = $this->awardServiceContract->luckyWheel();
            DB::commit();
            return $this->response->respondSuccess(AwardResource::make($selectedAward));
        } catch (\Exception $exception) {
            Log::error(route('lucky-wheel'), [__FILE__ => $exception->getMessage()]);
            DB::rollBack();
            return $this->response->respondBadRequest($exception->getMessage(), $exception->getCode());
        }
    }

}
