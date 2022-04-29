<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\DTO;

use Lihq1403\Web3Helper\Amount\AbstractAmount;
use Lihq1403\Web3Helper\Credential;
use phpseclib\Math\BigInteger;

class TransactorDTO
{
    /**
     * @var Credential 发起人
     */
    public Credential $from;

    /**
     * @var string 目标账户地址
     */
    public string $to;

    /**
     * @var ?AbstractAmount 要发送的币金额
     */
    public ?AbstractAmount $value = null;

    /**
     * @var ?string 可包括任意数据的可选字段
     */
    public ?string $data = null;

    /**
     * @var ?int 交易计数
     */
    public ?int $nonce = null;

    /**
     * @var ?string 链id
     */
    public ?string $chainId = null;

    /**
     * @var ?BigInteger Gas价格
     */
    public ?BigInteger $gasPrice = null;

    /**
     * @var ?BigInteger 交易能消耗Gas的上限
     */
    public ?BigInteger $gasLimit = null;

    public function getEstimateGasTx(): array
    {
        return [
            'from' => $this->from->getAddress(),
            'to' => $this->to,
            'nonce' => $this->nonce,
            'chainId' => $this->chainId,
            'value' => '0x' . $this->getValue(),
            'gasPrice' => '0x' . $this->gasPrice->toHex(),
        ];
    }

    public function getTx(): array
    {
        return [
            'from' => $this->from->getAddress(),
            'to' => $this->to,
            'nonce' => $this->nonce,
            'chainId' => $this->chainId,
            'value' => '0x' . $this->getValue(),
            'gasPrice' => '0x' . $this->gasPrice->toHex(),
            'gasLimit' => '0x' . $this->gasLimit->toHex(),
        ];
    }

    protected function getValue(): string
    {
        return (new BigInteger($this->value->getWei()))->toHex();
    }
}
