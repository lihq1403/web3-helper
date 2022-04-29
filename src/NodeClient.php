<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

use Lihq1403\Web3Helper\Constants\Net;
use phpseclib\Math\BigInteger;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Web3;

class NodeClient extends Web3
{
    private function __construct(string $url, int $timeout = 10)
    {
        $provider = new HttpProvider(
            new HttpRequestManager($url, $timeout)
        );
        parent::__construct($provider);
    }

    public static function create(string $net = Net::BSC_MAIN, int $timeout = 10): NodeClient
    {
        return new static($net, $timeout);
    }

    /**
     * 获取余额.
     */
    public function getBalance(string $address): BigInteger
    {
        $cb = new Callback();
        $this->getEth()->getBalance($address, $cb);
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

    /**
     * 当前的gas价格.
     */
    public function gasPrice(): BigInteger
    {
        $cb = new Callback();
        $this->getEth()->gasPrice($cb);
        return $cb->result;
    }

    /**
     * 返回指定地址发出的交易数量.
     */
    public function getTransactionCount(string $address, string $defaultBlock = 'pending'): string
    {
        $cb = new Callback();
        $this->getEth()->getTransactionCount($address, $defaultBlock, $cb);
        return $cb->result;
    }

    /**
     * 当前的网络ID.
     */
    public function version(): string
    {
        $cb = new Callback();
        $this->getNet()->version($cb);
        return $cb->result;
    }

    public function getChainId(): string
    {
        return $this->version();
    }
}
