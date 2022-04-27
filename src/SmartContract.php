<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

use Web3\Contract;

class SmartContract extends Contract
{
    protected ?NodeClient $web3;

    protected ?Credential $credential;

    protected array $viewMethods = [];

    protected array $txMethods = [];

    public function __construct(string $contractAddress, string $abi, ?NodeClient $web3 = null, ?Credential $credential = null)
    {
        $this->at($contractAddress);

        is_null($web3) && $web3 = $this->_defaultWeb3();

        parent::__construct($web3->getProvider(), $abi);
        $this->credential = $credential;

        foreach ($this->functions as $function) {
            switch ($function['stateMutability'] ?? '') {
                case 'view':
                    $this->viewMethods[] = $function['name'];
                    break;
                case 'payable':
                    $this->txMethods[] = $function['name'];
                    break;
                default:
            }
        }
    }

    public function __call($name, $arguments)
    {
        if ($this->_isViewMethod($name)) {
        }

        if ($this->_isTxMethod($name)) {
        }
    }

    public function setCredential(Credential $credential): self
    {
        $this->credential = $credential;

        return $this;
    }

    public function setWeb3(NodeClient $web3): self
    {
        $this->web3 = $web3;

        return $this;
    }

    private function _isTxMethod($name): bool
    {
        return in_array($name, $this->txMethods);
    }

    private function _isViewMethod($name): bool
    {
        return in_array($name, $this->viewMethods);
    }

    private function _defaultWeb3(): NodeClient
    {
        return NodeClient::create();
    }
}
