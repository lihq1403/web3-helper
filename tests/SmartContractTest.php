<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\SmartContract;
use Lihq1403\Web3Helper\Tests\Contract\MyContract;

/**
 * @internal
 * @coversNothing
 */
class SmartContractTest extends BaseTest
{
    public function testView()
    {
        $contract = $this->_getContract();

        $result = $contract->get();

        $this->assertIsString($result);
    }

    public function testTx()
    {
        $contract = $this->_getContract();

        $value = 'hello world';

        $contract->set($value);

        $this->assertEquals($value, $contract->get());
    }

    private function _getContract(): SmartContract
    {
        $contract = new MyContract();
        return new SmartContract($contract, $this->_getNodeClient(), $this->_getCredential());
    }
}
