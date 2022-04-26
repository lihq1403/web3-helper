<?php

/*
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\NodeClient;
use PHPUnit\Framework\TestCase;

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

        $this->assertIsString($balance);
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
}
