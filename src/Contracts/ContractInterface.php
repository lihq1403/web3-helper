<?php

namespace Lihq1403\Web3Helper\Contracts;

interface ContractInterface
{
    public function getContractAddress(): string;

    public function getAbi(): string;
}