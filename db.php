<?php

$db = new PDO("mysql:host=localhost;port=3306;dbname=kinenveut","root","");
$db->exec("set search_path to framwhop");
function db()
{
	global $db; return $db;
}
