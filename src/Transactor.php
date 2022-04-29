<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

use Lihq1403\Web3Helper\Amount\WeiAmount;
use Lihq1403\Web3Helper\DTO\TransactorDTO;
use phpseclib\Math\BigInteger;

class Transactor
{
    protected NodeClient $web3;

    protected Credential $credential;

    public function __construct(NodeClient $web3, Credential $credential)
    {
        $this->web3 = $web3;
        $this->credential = $credential;
    }

    public function transact(TransactorDTO $transactorDTO): string
    {
        // 生成交易数据
        $tx = $this->generateTransactTx($transactorDTO);

        // 为交易生成签名
        $signTx = $this->credential->signTransaction($tx);

        // 向节点提交一个已签名的交易
        return $this->_sendRawTransaction($signTx);
    }

    protected function generateTransactTx(TransactorDTO $transactorDTO): array
    {
        $transactorDTO->from = $this->credential;

        if (is_null($transactorDTO->chainId)) {
            $transactorDTO->chainId = $this->web3->version();
        }

        if (is_null($transactorDTO->nonce)) {
            $transactorDTO->nonce = intval($this->web3->getTransactionCount($this->credential->getAddress()));
        }

        if (is_null($transactorDTO->value)) {
            $transactorDTO->value = WeiAmount::make(0);
        }

        if (is_null($transactorDTO->gasPrice)) {
            $transactorDTO->gasPrice = $this->web3->gasPrice();
        }

        if (is_null($transactorDTO->gasLimit)) {
            $transactorDTO->gasLimit = $this->_estimateGasUsage($transactorDTO);
        }

        return $transactorDTO->getTx();
    }

    private function _estimateGasUsage(TransactorDTO $transactorDTO): BigInteger
    {
        $cb = new Callback();
        $this->web3->getEth()->estimateGas($transactorDTO->getEstimateGasTx(), $cb);
        return $cb->result;
    }

    private function _sendRawTransaction(string $signTx)
    {
        $cb = new Callback();
        $this->web3->getEth()->sendRawTransaction($signTx, $cb);
        return $cb->result;
    }
}
