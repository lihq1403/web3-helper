<?php

namespace Lihq1403\Web3Helper\Exceptions;

use Lihq1403\Web3Helper\Constants\ErrorCode;

class ContractException extends Web3HelperException
{
    public function __construct($message = 'contract error', $code = ErrorCode::CONTRACT_ERROR, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}