<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\Constants\Net;
use Lihq1403\Web3Helper\NodeClient;
use phpseclib\Math\BigInteger;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class NodeClientTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(NodeClient::class, $this->_getNodeClient());
    }

    public function testGetBalance()
    {
        $node = $this->_getNodeClient();

        $balance = $node->getBalance('0x99FfB015907572346741C52D5955241A079Ad30C');

        $this->assertInstanceOf(BigInteger::class, $balance);
    }

    public function testBlockNumber()
    {
        $node = $this->_getNodeClient();

        $number = $node->blockNumber();

        $this->assertIsString($number);
    }

    public function testGetBlockByNumber()
    {
        $node = $this->_getNodeClient();

        $block = $node->getBlockByNumber('17190255', true);

        $this->assertNotEmpty($block);
    }

    public function testGasPrice()
    {
        $node = $this->_getNodeClient();

        $gas = $node->gasPrice();

        $this->assertInstanceOf(BigInteger::class, $gas);
    }

    public function testGetTransactionCount()
    {
        $node = $this->_getNodeClient();

        $nonce = $node->getTransactionCount('0xC0169Cb4E02e5F2F8A322Dc1878eBE1bfbaA5ae3');

        $this->assertInstanceOf(BigInteger::class, $nonce);
    }

    public function testVersion()
    {
        $node = $this->_getNodeClient();

        $result = $node->version();

        $this->assertIsString($result);
    }

    private function _getNodeClient()
    {
        return NodeClient::create(Net::TEST);
    }
}
