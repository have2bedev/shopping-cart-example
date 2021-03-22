<?php
ob_start();
session_start();
error_reporting(1);
ini_set('display_errors', 1);
$products = [
	1 => [
		'name' => 'Product 1',
		'price' => '50.00'
	],
	2 => [
		'name' => 'Product 2',
		'price' => '75.00'
	],
	3 => [
		'name' => 'Product 3',
		'price' => '100.00'
	],
	4 => [
		'name' => 'Product 3',
		'price' => '100.00'
	],
];