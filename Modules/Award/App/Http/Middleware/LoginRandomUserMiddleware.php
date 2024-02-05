<?php

namespace Modules\Award\App\Http\Middleware;
use Closure;
use Modules\User\App\Repositories\V1\Contracts\UserRepositoryContract;

class LoginRandomUserMiddleware
{

    public function __construct(protected UserRepositoryContract $userRepositoryContract)
    {
    }

    public function handle($request, Closure $next)
    {
        $randomUser = $this->userRepositoryContract->getRandomUser();
        auth()->login($randomUser);

        return $next($request);
    }
}
