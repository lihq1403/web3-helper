<?php
/**
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

    private function __construct(string $url, int $timeout = 10)
    {
        $provider = new HttpProvider(
            new HttpRequestManager($url, $timeout)
        );
        parent::__construct($provider);
    }

    public static function create(string $net = self::MAIN_NET, int $timeout = 10): NodeClient
    {
        if (!in_array($net, [self::MAIN_NET, self::TEST_NET])) {
            throw new NodeClientException('unsupported network');
        }

        return new static($net, $timeout);
    }

    /**
     * 获取余额.
     */
    public function getBalance(string $address)
    {
        $cb = new Callback();
        $this->getEth()->getBalance($address, $cb);
        if (method_exists($cb->result, 'toString')) {
            return $cb->result->toString();
        }

        return $cb->result;
    }

    /**
     * 获取最新的区块高度.
     */
    public function blockNumber()
    {
        $cb = new Callback();
        $this->getEth()->blockNumber($cb);
        if (method_exists($cb->result, 'toString')) {
            return $cb->result->toString();
        }

        return $cb->result;
    }

    /**
     * 获取区块信息.
     */
    public function getBlockByNumber(string $number, bool $whole = false)
    {
        $cb = new Callback();
        if (is_numeric($number)) {
            $number = BscHelper::hex($number);
        }
        $this->getEth()->getBlockByNumber(BscHelper::hex($number), $whole, $cb);

        return $cb->result;
    }
}
