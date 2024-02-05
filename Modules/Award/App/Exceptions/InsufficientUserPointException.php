<?php

namespace Modules\Award\App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InsufficientUserPointException extends Exception
{
    public function __construct(
        string $message = 'Your current score is not sufficient for this operation',
        int $code = Response::HTTP_UNPROCESSABLE_ENTITY,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
