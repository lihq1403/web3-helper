<?php

/*
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Lihq1403\Web3Helper;

use Lihq1403\Web3Helper\Exceptions\NodeClientException;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Web3;

class NodeClient extends Web3
{
    const MAIN_NET = 'https://bsc-dataseed1.binance.org/';

    const TEST_NET = 'https://data-seed-prebsc-1-s1.binance.org:8545/';

    private function __construct(string $url)
    {
        $provider = new HttpProvider(
            new HttpRequestManager($url, 300)
        );
        parent::__construct($provider);
    }

    public static function create(string $net = self::MAIN_NET): NodeClient
    {
        if (!in_array($net, [self::MAIN_NET, self::TEST_NET])) {
            throw new NodeClientException('unsupported network');
        }

        return new static($net);
    }

    public function getBalance(string $address)
    {
    }
}
