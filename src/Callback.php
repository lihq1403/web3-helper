<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

class Callback
{
    public $result;

    public function __invoke($error, $result)
    {
        if ($error) {
            throw $error;
        }
        $this->result = $result;
    }
}
