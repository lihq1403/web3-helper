<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Amount;

use Web3\Utils;

class WeiAmount extends AbstractAmount
{
    private function __construct(string $wei)
    {
        $this->calculation($wei);
    }

    public static function make($wei): WeiAmount
    {
        return new static(strval($wei));
    }

    protected function calculation(string $wei)
    {
        $this->wei = Utils::toWei($wei, 'wei');
        [$this->quotient, $this->remainder] = Utils::toEther($this->wei->toString(), 'wei');
    }
}
