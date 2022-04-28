<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

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
        $transactorDTO->from = $this->credential;

        if (is_null($transactorDTO->nonce)) {
            $transactorDTO->nonce = $this->web3->getTransactionCount($this->credential->getAddress());
        }

        if (is_null($transactorDTO->chainId)) {
            $transactorDTO->chainId = $this->web3->getChainId();
        }

        if (is_null($transactorDTO->value)) {
            $transactorDTO->value = new BigInteger(0);
        }

        if (is_null($transactorDTO->gasPrice)) {
            $transactorDTO->gasPrice = $this->web3->gasPrice();
        }

        if (is_null($transactorDTO->gasLimit)) {
            $transactorDTO->gasLimit = $this->web3->gasPrice();
        }

        $tx = $transactorDTO->getTx();
    }
}
