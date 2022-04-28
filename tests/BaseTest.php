<?php
namespace Lihq1403\Web3Helper\Tests;
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
use Lihq1403\Web3Helper\Constants\Net;
use Lihq1403\Web3Helper\Credential;
use Lihq1403\Web3Helper\Kit;
use Lihq1403\Web3Helper\NodeClient;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BaseTest extends TestCase
{
    protected function _getNodeClient(): NodeClient
    {
        return NodeClient::create(Net::TEST);
    }

    protected function _getCredential(): Credential
    {
        return Credential::fromKey('d37d6e730ce806e4b78c38451d342e76e7eaecbe64b825b70eda8d267f3a9a1b');
    }

    protected function _getKit(): Kit
    {
        return new Kit($this->_getNodeClient(), $this->_getCredential());
    }
}
