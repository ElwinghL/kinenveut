<?php

function my_autoloader($name)
{
  $dir = '';
  if (stripos($name, 'Model') !== false) {
    $dir = 'model';
  } elseif (stripos($name, 'Controller') !== false) {
    $dir = 'controller';
  } elseif (stripos($name, 'Bo') !== false) {
    $dir = 'service/bo';
  } elseif (stripos($name, 'Dao') !== false) {
    $dir = 'service/dao';
  }
  include_once $dir . '/' . $name . '.php';
}

spl_autoload_register('my_autoloader');

/*
 * Protection des chaînes avant insertion dans une requête SQL
 *
 * Avant insertion dans une requête SQL, toutes les chaines contenant certains caractères spéciaux (", ', ...) 
 * doivent être protégées. En particulier, toutes les chaînes provenant de saisies de l'utilisateur doivent l'être. 
 * Echappe les caractères spéciaux d'une chaîne (en particulier les guillemets) 
 * Permet de se protéger contre les attaques de type injections SQL
 *
 * @param 	string 		$str 	La chaîne à protéger
 * @return 	string 				La chaîne protégée
 */
function protectStringBeforeSQL($str) {
	$str = trim($str);
	return db()->quote($str);
}


