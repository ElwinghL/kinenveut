<?php

$db = new PDO("mysql:host=localhost;port=3307;dbname=test","root","");
$db->exec("set search_path to framwhop");
function db()
{
	global $db; return $db;
}
