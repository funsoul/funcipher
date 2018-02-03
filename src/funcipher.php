<?php

/*
 * This file is part of the funsoul/funcipher.
 *
 * (c) funsoul <funsoul.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Funsoul\Funcipher;
/*
 * Custom random ciphertext.
 *
 * @author    funsoul <funsoul.org>
 * @copyright 2018 funsoul <funsoul.org>
 *
 * @link      https://github.com/funsoul/funcipher
 * @link      http://funsoul.org
 */
define('CIPHER_USE_LOWER', 0);
define('CIPHER_USE_CAPITAL', 1);
define('CIPHER_USE_NUMBER', 2);
define('CIPHER_USE_SPECIAL', 3);
Class Funcipher
{
    const USE_LOWER = 0;
    const USE_CAPITAL = 1;
    const USE_NUMBER = 2;
    const USE_SPECIAL = 3;

    const CHAR_LIST = [
        'abcdefghijklmnopqrstuvwxyz',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '0123456789',
        '|!@#$%&*\/=?,;.:\-_+~^'
    ];

    /**
     * create random ciphertext
     * @param int $length
     * @param array $codeKey
     * @return string
     */
    public static function create($length = 20, $codeKey = [self::USE_LOWER, self::USE_CAPITAL, self::USE_NUMBER, self::USE_SPECIAL]) {
        $code = '';
        $codeKeyLength = count($codeKey);
        for ($i = 0; $i < $length; $i++) {
            $codeKeyIndex = mt_rand(0, $codeKeyLength - 1);
            $charsKey = $codeKey[$codeKeyIndex];
            $strIndex = mt_rand(0, strlen(self::CHAR_LIST[$charsKey]) - 1);
            $str = self::CHAR_LIST[$charsKey];
            $code .= $str[$strIndex];
        }
        return $code;
    }
}
