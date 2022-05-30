<h1 align="center"> web3-helper </h1>

<p align="center"> web3-helper.</p>


## Installing


```shell
$ composer require lihq1403/web3-helper -vvv
```
### ganache本地开发环境
ganache 客户端下载：https://trufflesuite.com/ganache/

docker下载
```shell
docker run -d -p 8545:8545 --name ganache trufflesuite/ganache
```

### bsc测试链
```
Network Name（网络名称）：
                           bsc-testnet
New RPC URL（新增RPC URL）：
                           https://data-seed-prebsc-1-s3.binance.org:8545/
                     (或者) https://data-seed-prebsc-1-s2.binance.org:8545/
                     (或者) https://data-seed-prebsc-2-s3.binance.org:8545/
                     (或者) https://data-seed-prebsc-2-s1.binance.org:8545/
                     (或者) https://data-seed-prebsc-1-s1.binance.org:8545/
                     (或者) https://data-seed-prebsc-2-s2.binance.org:8545/
Chain ID（链ID）：
                           97
Currency Symbol (optional)（符号（选填））：
                           BNB
Block Explorer URL (optional)（币安智能链浏览器）：
                           https://testnet.bscscan.com
```
### bsc测试
- 申请测试币 https://testnet.binance.org/faucet-smart
- bsc测试网浏览器 https://testnet.bscscan.com/

### 合约开发
- 智能合约IDE http://remix.ethereum.org/

## Usage

### 文件说明
```
src
├── Amount // 金额相关的计算
│   ├── AbstractAmount.php
│   ├── BnqBnrAmount.php
│   ├── EtherAmount.php
│   └── WeiAmount.php
├── BscHelper.php
├── Callback.php
├── Constants
│   ├── ErrorCode.php
│   └── Net.php
├── Contracts
│   └── ContractInterface.php
├── Credential.php // 账户
├── DTO
│   └── TransactorDTO.php
├── Exceptions
│   ├── ContractException.php
│   ├── NodeClientException.php
│   └── Web3HelperException.php
├── Kit.php // 工具
├── NodeClient.php // 节点
├── SmartContract.php // 智能合约
└── Transactor.php // 交易

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/lihq1403/web3-helper/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/lihq1403/web3-helper/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT