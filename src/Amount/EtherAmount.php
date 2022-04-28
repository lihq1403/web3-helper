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

class EtherAmount extends AbstractAmount
{
    public function __construct(string $bnb)
    {
        $this->calculation($bnb);
    }

    public static function make($bnb): EtherAmount
    {
        return new static(strval($bnb));
    }

    protected function calculation(string $bnb)
    {
        $this->wei = Utils::toWei($bnb, 'ether');
        [$this->quotient, $this->remainder] = Utils::toEther($this->wei->toString(), 'wei');
    }
}
