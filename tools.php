<?php

function my_autoloader($name)
{
	$dir = "model";
	if (stripos($name, "Controller") !== FALSE)
		$dir = "controller";
	include_once $dir."/".$name.".php";
}
spl_autoload_register('my_autoloader');