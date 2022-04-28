<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\Amount\WeiAmount;
use phpseclib\Math\BigInteger;

/**
 * @internal
 * @coversNothing
 */
class KitTest extends BaseTest
{
    public function testBalanceOf()
    {
        $kit = $this->_getKit();
        $balance = $kit->balanceOf('0x0F1201359EF74212b99D0987169Dda38bEC5a921');

        $this->assertInstanceOf(BigInteger::class, $balance);

        $amount = WeiAmount::make($balance->toString());

        $this->assertEquals('1000000000000000000000', $amount->getWei());
        $this->assertEquals('1000', $amount->getEther());
        $this->assertEquals(1000, $amount->getQuotient());
        $this->assertEquals(0, $amount->getRemainder());
    }
}
