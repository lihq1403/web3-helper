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

class Kit
{
    protected NodeClient $web3;

    protected Credential $credential;

    protected Transactor $transactor;

    public function __construct(NodeClient $web3, Credential $credential)
    {
        $this->web3 = $web3;
        $this->credential = $credential;
        $this->transactor = new Transactor($web3, $credential);
    }

    public function getCredential(): Credential
    {
        return $this->credential;
    }

    public function getSender(): string
    {
        return $this->credential->getAddress();
    }

    public function balanceOf(?string $address = null): BigInteger
    {
        if (is_null($address)) {
            $address = $this->credential->getAddress();
        }
        return $this->web3->getBalance($address);
    }

    public function transfer(TransactorDTO $transactorDTO): string
    {
        return $this->transactor->transact($transactorDTO);
    }
}
