<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper\Tests\Contract;

use Lihq1403\Web3Helper\Contracts\ContractInterface;

class MyContract implements ContractInterface
{
    public function getContractAddress(): string
    {
        return '0xCD511ed3822e25e55FbD135160368B2D675d7226';
    }

    public function getAbi(): string
    {
        return '[
                    {
                        "inputs": [
                            {
                                "internalType": "string",
                                "name": "_value",
                                "type": "string"
                            }
                        ],
                        "name": "set",
                        "outputs": [],
                        "stateMutability": "nonpayable",
                        "type": "function"
                    },
                    {
                        "inputs": [],
                        "stateMutability": "nonpayable",
                        "type": "constructor"
                    },
                    {
                        "inputs": [],
                        "name": "get",
                        "outputs": [
                            {
                                "internalType": "string",
                                "name": "",
                                "type": "string"
                            }
                        ],
                        "stateMutability": "view",
                        "type": "function"
                    }
                ]';
    }
}
