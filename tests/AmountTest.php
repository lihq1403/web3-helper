<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\Amount\BnqBnrAmount;
use Lihq1403\Web3Helper\Amount\EtherAmount;
use Lihq1403\Web3Helper\Amount\WeiAmount;

/**
 * @internal
 * @coversNothing
 */
class AmountTest extends BaseTest
{
    const WEI = '2105000000000000000';

    const ETHER = '2.105';

    const QUOTIENT = 2;

    const REMAINDER = 105000000000000000;

    public function testWei()
    {
        $amount = WeiAmount::make(self::WEI);

        $this->assertEquals(self::WEI, $amount->getWei());
        $this->assertEquals(self::ETHER, $amount->getEther());
        $this->assertEquals(self::QUOTIENT, $amount->getQuotient());
        $this->assertEquals(self::REMAINDER, $amount->getRemainder());
    }

    public function testEther()
    {
        $amount = EtherAmount::make(self::ETHER);

        $this->assertEquals(self::WEI, $amount->getWei());
        $this->assertEquals(self::ETHER, $amount->getEther());
        $this->assertEquals(self::QUOTIENT, $amount->getQuotient());
        $this->assertEquals(self::REMAINDER, $amount->getRemainder());
    }

    public function testBnqBnr()
    {
        $amount = BnqBnrAmount::make(self::QUOTIENT, self::REMAINDER);

        $this->assertEquals(self::WEI, $amount->getWei());
        $this->assertEquals(self::ETHER, $amount->getEther());
        $this->assertEquals(self::QUOTIENT, $amount->getQuotient());
        $this->assertEquals(self::REMAINDER, $amount->getRemainder());
    }
}
