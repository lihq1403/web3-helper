<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Amount;

use phpseclib\Math\BigInteger;

class AbstractAmount
{
    protected BigInteger $wei;

    protected BigInteger $quotient;

    protected BigInteger $remainder;

    /**
     * 商.
     */
    public function getQuotient(): int
    {
        return intval($this->quotient->toString());
    }

    /**
     * 余数.
     */
    public function getRemainder(): int
    {
        return intval($this->remainder->toString());
    }

    /**
     * 获取wei单位.
     */
    public function getWei(): string
    {
        return $this->wei->toString();
    }

    /**
     * 获取ether单位.
     */
    public function getEther(): string
    {
        $ether = bcdiv($this->getWei(), '1000000000000000000', 20);
        if (bccomp($ether, '0', 20) === 0) {
            return '0';
        }
        return rtrim(rtrim($ether, '0'), '.');
    }
}
