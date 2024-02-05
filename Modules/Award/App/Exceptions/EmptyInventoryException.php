<?php

namespace Modules\Award\App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class EmptyInventoryException extends Exception
{
    public function __construct(
        string $message = 'The inventory is currently empty.',
        int $code = Response::HTTP_SERVICE_UNAVAILABLE,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
