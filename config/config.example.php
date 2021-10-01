<?php 
ob_start();
$config = [
	'name' => '<?= $config['name'] ?>',
	'mysql' => [
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'db' => 'search_engine'
	]
];

try{
	$con = new PDO("mysql:host={$config['mysql']['host']};dbname={$config['mysql']['db']}", $config['mysql']['user'], $config['mysql']['pass']);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExeption $e){
	echo "Connection failed: " . $e->getMessage();
}