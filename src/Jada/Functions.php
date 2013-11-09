<?php
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