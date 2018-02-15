<?php

// $domain = si une partie du texte saisi est invalide, celà le remplacera par des caractères standards
$domain = substr(preg_replace("/[^a-z0-9._-]/", "", $_SERVER["HTTP_HOST"]), 0, 30);
require "config.".$domain.".php";

//Nouvelle connexion entre php et la base de données. 
try {
	$bdd = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
//Attrape les exceptions 'Exeption' s'il y en a : sortie et message d'erreur correspondant
catch(Exeption $e)
{
	die('Error : '.$e->getMessage());
}
?>