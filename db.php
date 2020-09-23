<?php

$db = new PDO("mysql:host=localhost;port=5433;dbname=test","riddsaw","test");
$db->exec("set search_path to framwhop");

function db()
{
	global $db; return $db;
}
