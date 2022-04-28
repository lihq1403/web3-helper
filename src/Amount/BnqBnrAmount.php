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

class BnqBnrAmount extends AbstractAmount
{
    public function __construct(int $quotient, int $remainder)
    {
        $this->calculation($quotient, $remainder);
    }

    public static function make($quotient, $remainder): BnqBnrAmount
    {
        return new static(intval($quotient), intval($remainder));
    }

    protected function calculation(int $quotient, int $remainder)
    {
        $this->wei = Utils::toWei(bcadd(Utils::toWei(strval($quotient), 'ether')->toString(), Utils::toWei(strval($remainder), 'wei')->toString()), 'wei');
        [$this->quotient, $this->remainder] = Utils::toEther($this->getWei(), 'wei');
    }
}
