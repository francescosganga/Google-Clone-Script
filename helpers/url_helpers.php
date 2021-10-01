<?php
include("../config/config.php");
function project_url($path = NULL) {
	global $config;	
	if (substr($path,0,1) == "/") {
		$path = substr_replace($path,"",0,1);
	}
	if($config['subdirectory'] === '')
		return "https://".$_SERVER['HTTP_HOST'] . "/" . $path;
	return "https://{$_SERVER['HTTP_HOST']}/{$config['subdirectory']}/{$path}";
}