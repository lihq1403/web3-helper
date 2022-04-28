<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

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
        $node = NodeClient::create();

        $this->assertInstanceOf(NodeClient::class, $node);
    }

    public function testGetBalance()
    {
        $node = NodeClient::create();

        $balance = $node->getBalance('0xA120D1F347178DaaEd13983844490558D9b0c3A5');

        $this->assertInstanceOf(BigInteger::class, $balance);
    }

    public function testBlockNumber()
    {
        $node = NodeClient::create();

        $number = $node->blockNumber();

        $this->assertIsString($number);
    }

    public function testGetBlockByNumber()
    {
        $node = NodeClient::create();

        $block = $node->getBlockByNumber('17190255', true);

        $this->assertNotEmpty($block);
    }

    public function testGasPrice()
    {
        $node = NodeClient::create();

        $gas = $node->gasPrice();

        $this->assertInstanceOf(BigInteger::class, $gas);
    }

    public function testGetTransactionCount()
    {
        $node = NodeClient::create();

        $nonce = $node->getTransactionCount('0xA120D1F347178DaaEd13983844490558D9b0c3A5');

        $this->assertInstanceOf(BigInteger::class, $nonce);
    }

    public function testVersion()
    {
        $node = NodeClient::create();

        $result = $node->version();

        $this->assertIsString($result);
    }
}
