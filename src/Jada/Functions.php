<?php
define ('ROOT', dirname(dirname(dirname(__FILE__))));
/**
 * The global helper functions which can be used in both application & framework level
 * @author Aras Can Akin <aacanakin@gmail.com>
 * @license MIT
 */

/**
 * Function performs a var_dump with return options
 */
function d($data, $return = false)
{
	if ($return) {
		return var_export($data);
	} else {
		var_dump($data);
	}
}

/**
 * Function performs a print_r with return options
 */
function p($data, $return = false)
{
	if (! is_array($data)) {
		$data .= "\n";
	}
	
	if ($return) {

		$return = print_r($data, $return);
		return $return;

	} else {
		print_r($data, $return);
	}
}

function pe($data, $return = false)
{
	p($data, $return);
	exit;
}

function de($data, $return = false)
{
	d($data, $return);
	exit;
}

function rstrtrim($str, $remove=null) 
{ 
    $str    = (string)$str; 
    $remove = (string)$remove;    
    
    if(empty($remove)) 
    { 
        return rtrim($str); 
    } 
    
    $len = strlen($remove); 
    $offset = strlen($str)-$len; 
    while($offset > 0 && $offset == strpos($str, $remove, $offset)) 
    { 
        $str = substr($str, 0, $offset); 
        $offset = strlen($str)-$len; 
    } 
    
    return rtrim($str);   
}
