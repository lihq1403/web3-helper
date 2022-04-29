<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests;

use Lihq1403\Web3Helper\Credential;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class CredentialTest extends TestCase
{
    public function testFromKey()
    {
        $key = 'e6639f0ebebebce530b6993178fb5cdf86334442836a41abac77d445e0404b37';

        $credential = Credential::fromKey($key);

        $this->assertSame($key, $credential->getPrivateKey());
        $this->assertSame('0xA120D1F347178DaaEd13983844490558D9b0c3A5', $credential->getAddress());
        $this->assertSame('0456ee8647226c43999b984e67d9c28274989fbde036d2f4a1ab052cdca7910ae2902ab6b383c48969ab3c92706076125ac90aa0d1c09ab079b4f230adf8adb834', $credential->getPublicKey());
    }

    public function testCreate()
    {
        $credential = Credential::create();

        $credential2 = Credential::fromKey($credential->getPrivateKey());

        $this->assertSame($credential->getAddress(), $credential2->getAddress());
    }

    public function testGetPublicKey()
    {
        $key = 'e6639f0ebebebce530b6993178fb5cdf86334442836a41abac77d445e0404b37';

        $credential = Credential::fromKey($key);

        $this->assertSame('0456ee8647226c43999b984e67d9c28274989fbde036d2f4a1ab052cdca7910ae2902ab6b383c48969ab3c92706076125ac90aa0d1c09ab079b4f230adf8adb834', $credential->getPublicKey());
    }

    public function testetPrivateKey()
    {
        $key = 'e6639f0ebebebce530b6993178fb5cdf86334442836a41abac77d445e0404b37';

        $credential = Credential::fromKey($key);

        $this->assertSame($key, $credential->getPrivateKey());
    }

    public function testGetAddress()
    {
        $key = 'e6639f0ebebebce530b6993178fb5cdf86334442836a41abac77d445e0404b37';

        $credential = Credential::fromKey($key);

        $this->assertSame('0xA120D1F347178DaaEd13983844490558D9b0c3A5', $credential->getAddress());
    }
}
