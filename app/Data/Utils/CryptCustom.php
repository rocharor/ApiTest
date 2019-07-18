<?php

namespace App\Data\Utils;

class CryptCustom
{
    public static function cryptCustom($id)
    {
        $id = str_pad($id, 6, "cibb", STR_PAD_LEFT);
    	$hash = md5($id);
    	$hashAux = str_split($hash);
    	$arry_dividido = array_chunk($hashAux,10);
    	foreach (str_split($id) as $key=>$value) {
    		$arry_dividido[1][$key] = $value;
    	}
    	foreach ($arry_dividido as &$value) {
    		$value = implode($value);
    	}
    	$hashCustom = implode('',$arry_dividido);

    	return $hashCustom;
    }

    public static function decryptCustom($hash)
    {
    	$hashAux = str_split($hash);
    	$arry_dividido = array_chunk($hashAux,10);
    	$arrId = [];
    	foreach ($arry_dividido[1] as $key=>$value) {
    		if ($key <= 5) {
    			$arrId[] = $value;
    		}
    	}
    	$id = preg_replace('/[^0-9]/','',implode('', $arrId));

    	return $id;
    }

}
