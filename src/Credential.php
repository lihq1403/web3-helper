<?php
/**
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */
namespace Lihq1403\Web3Helper;

use Elliptic\EC;
use Elliptic\EC\KeyPair;
use kornrunner\Keccak;
use Web3\Utils;
use Web3p\EthereumTx\Transaction;

class Credential
{
    const EC_OPTIONS = 'secp256k1';

    private KeyPair $keyPair;

    private function __construct(KeyPair $keyPair)
    {
        $this->keyPair = $keyPair;
    }

    /**
     * 公钥.
     */
    public function getPublicKey(): string
    {
        return $this->keyPair->getPublic(false, 'hex');
    }

    /**
     * 私钥.
     */
    public function getPrivateKey(): string
    {
        return $this->keyPair->getPrivate('hex');
    }

    /**
     * 地址.
     */
    public function getAddress(bool $origin = false): string
    {
        $address = '0x' . substr(Keccak::hash(substr(hex2bin($this->getPublicKey()), 1), 256), 24);

        if ($origin) {
            return $address;
        }

        return Utils::toChecksumAddress($address);
    }

    public static function create(): Credential
    {
        $ec = new EC(static::EC_OPTIONS);
        $keyPair = $ec->genKeyPair();

        return new static($keyPair);
    }

    public static function fromKey(string $privateKey): Credential
    {
        $ec = new EC(static::EC_OPTIONS);
        $keyPair = $ec->keyFromPrivate($privateKey);

        return new static($keyPair);
    }

    /**
     * 为交易生成签名.
     */
    public function signTransaction(array $raw): string
    {
        return '0x' . (new Transaction($raw))->sign($this->getPrivateKey());
    }
}
