<?php

$dotenv->required(['host', 'port', 'dbname', 'user', 'password']);
$db = new PDO('mysql:host=' . $_ENV['host'] . ';port=' . $_ENV['port'] . ';dbname=' . $_ENV['dbname'], $_ENV['user'], $_ENV['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function db()
{
  global $db;

  return $db;
}
