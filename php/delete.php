<?php
session_start();

// inclut et exécute connect.php
require 'connect.php';

// efface les bouteilles du tableau de la base de données
$req = $bdd->prepare('DELETE FROM bottles WHERE id = ?');
$req->execute(array(
	$_GET['id'] ));

// affiche un message
$msg = 'Bottle deleted';

// redirige vers la page références
header('Location: references.php?msg=' . $msg);
