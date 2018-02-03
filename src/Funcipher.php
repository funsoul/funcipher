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
use InvalidArgumentException;

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

    private $_ignore_chars = [];
    private $_char_list = [
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
    public function create($length = 20, $codeKey = [self::USE_LOWER, self::USE_CAPITAL, self::USE_NUMBER, self::USE_SPECIAL])
    {
        if(!is_numeric($length)){
            throw new InvalidArgumentException("First argument must be number");
        }
        if(!empty($this->_ignore_chars)){
            $this->popIgnoreChars();
            if(empty($this->_char_list)){
                return '';
            }
            $existCodeKey = array_keys($this->_char_list);
            $tmpCodeKey = [];
            foreach ($codeKey as $codeKeyItem){
                if(in_array($codeKeyItem, $existCodeKey)){
                    $tmpCodeKey[] = $codeKeyItem;
                }
            }
            $codeKey = $tmpCodeKey;
        }
        $code = '';
        $codeKeyLength = count($codeKey);
        for ($i = 0; $i < $length; $i++) {
            $codeKeyIndex = mt_rand(0, $codeKeyLength - 1);
            $charsKey = $codeKey[$codeKeyIndex];
            $strIndex = mt_rand(0, strlen($this->_char_list[$charsKey]) - 1);
            $str = $this->_char_list[$charsKey];
            $code .= $str[$strIndex];
        }
        return $code;
    }

    /**
     * Ignore unwanted characters.
     * @param array $chars
     * @return $this
     */
    public function ignore($chars = [])
    {
        if(!is_array($chars) || $this->checkIgnoreChars($chars)){
            throw new InvalidArgumentException("Arguments must be an array of characters,like this [1,'a','-']");
        }
        $this->_ignore_chars = $chars;
        return $this;
    }
    
    private function checkIgnoreChars($chars)
    {
        if(!empty($chars)){
            foreach ($chars as $char){
                if(strlen($char) > 1){
                    return true;
                }
            }
        }
        return false;
    }

    private function popIgnoreChars()
    {
        $tmpCharList = [];
        $i = 0;
        foreach ($this->_char_list as $chars){
            foreach (str_split($chars) as $char){
                if(in_array($char,$this->_ignore_chars)){
                    continue;
                }
                $tmpCharList[$i] .= $char;
            }
            $i++;
        }
        $this->_char_list = $tmpCharList;
    }
}