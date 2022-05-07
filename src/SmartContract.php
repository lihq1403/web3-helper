<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

use Lihq1403\Web3Helper\Contracts\ContractInterface;
use Lihq1403\Web3Helper\DTO\TransactorDTO;
use Lihq1403\Web3Helper\Exceptions\ContractException;
use Web3\Contract;

class SmartContract extends Contract
{
    protected ?NodeClient $web3;

    protected ?Credential $credential;

    protected array $viewMethods = [];

    protected array $txMethods = [];

    public function __construct(ContractInterface $contract, ?NodeClient $web3 = null, ?Credential $credential = null)
    {
        // 设置合约地址
        $this->at($contract->getContractAddress());

        // 选择web3节点
        is_null($web3) && $web3 = $this->_defaultWeb3();
        $this->web3 = $web3;

        parent::__construct($web3->getProvider(), $contract->getAbi());

        // 设置操作人
        $this->credential = $credential;

        // 分类abi接口
        foreach ($this->functions as $function) {
            switch ($function['stateMutability'] ?? '') {
                case 'view':
                    $this->viewMethods[] = $function['name'];
                    break;
                case 'payable':
                case 'nonpayable':
                    $this->txMethods[] = $function['name'];
                    break;
                default:
            }
        }
    }

    public function __call($name, $arguments)
    {
        $result = null;
        $this->_isViewMethod($name) && $result = $this->execView($name, $arguments);
        $this->_isTxMethod($name) && $result = $this->execTx($name, $arguments);
        return $result;
    }

    protected function execView($name, $arguments)
    {
        $cb = new Callback();
        $arguments[] = $cb;
        $this->call($name, ...$arguments);
        $values = array_values($cb->result);
        return count($values) > 1 ? $values : current($values);
    }

    protected function execTx($name, $arguments): string
    {
        if (is_null($this->credential)) {
            throw new ContractException('credential not set');
        }
        $data = $this->getData($name, ...$arguments);

        $transactor = new Transactor($this->web3, $this->credential);
        $dto = new TransactorDTO();
        $dto->to = $this->getToAddress();
        $dto->from = $this->credential;
        $dto->data = '0x' . $data;

        return $transactor->transact($dto);
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
