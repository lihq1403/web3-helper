<?php

/*
 * This file is part of the lihq1403/web3-helper.
 *
 * (c) lihq1403 <lihaiqing1994@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Lihq1403\Web3Helper;

use phpseclib\Math\BigInteger;

class BscHelper
{
    public static function hex($str, $prefix = true): string
    {
        $bn = gmp_init($str);
        $ret = gmp_strval($bn, 16);

        return $prefix ? '0x'.$ret : $ret;
    }

    public static function bn($n): BigInteger
    {
        return new BigInteger($n);
    }
}
