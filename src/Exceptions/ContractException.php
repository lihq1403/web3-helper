<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Exceptions;

use Lihq1403\Web3Helper\Constants\ErrorCode;

class ContractException extends Web3HelperException
{
    public function __construct($message = 'contract error', $code = ErrorCode::CONTRACT_ERROR, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
