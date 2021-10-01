<?php
ob_start();

if (!isset($_POST['url'])) {
	die('Re enter your url');
}

include('../classes/parser.php');
include('../config/config.php');

$url = $_POST['url'];

$query = $con->prepare("INSERT INTO sites (url) VALUES (:url)");
$query->bindParam(':url', $url);
if(!$query->execute())
    die('Error.');