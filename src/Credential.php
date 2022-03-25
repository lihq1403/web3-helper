<?php

/*
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

class Credential
{
    const EC_OPTIONS = 'secp256k1';

    private KeyPair $keyPair;

    private function __construct(KeyPair $keyPair)
    {
        $this->keyPair = $keyPair;
    }

    public function getPublicKey()
    {
        return $this->keyPair->getPublic(false, 'hex');
    }

    public function getPrivateKey()
    {
        return $this->keyPair->getPrivate('hex');
    }

    public function getAddress(bool $origin = false): string
    {
        $address = '0x'.substr(Keccak::hash(substr(hex2bin($this->getPublicKey()), 1), 256), 24);

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
}
