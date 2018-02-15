<?php

// pour rester connecter
session_start();

include 'connect.php';

// si $_FILES est défini, 
// $folder = le résultat que je trouve avec le chemin absolu 
// $file = (basename retourne le nom de la composante finale du chemin) de $_FILES['picture']['name']
if (isset($_FILES['picture'])) {
        $folder = realpath('../img').'/';
        $file = basename($_FILES['picture']['name']);


	//Pour déplacer $_FILES du dossier temporaire vers le dossier img s'il est valide
	//Si il s'est déplacé, la fonction retourne "success", sinon, elle retourne "error"
if (move_uploaded_file($_FILES['picture']['tmp_name'], $folder . $file)) {
        echo "success !";
} else {
        echo "error";
}
}

//prépare la requête à insérer dans la base de données
$req = $bdd->prepare('INSERT INTO bottles (name, year, grapes, country, region, description, picture) VALUES(:name, :year, :grapes, :country, :region, :description, :picture)');

//exécute la requête et les données sont enregistrées sous forme de tableau
$req->execute(array(
	'name'		 => $_POST['name'],
	'year'		 => $_POST['year'],
	'grapes'	 => $_POST['grapes'],
	'country'	 => $_POST['country'],
	'region'	 => $_POST['region'],
	'description'=> $_POST['description'],
	'picture'	 => $_FILES['picture']['name']
	));

//Celà envoie un message et redirige vers la page références
$msg = 'Bottle added';
   header('Location: references.php?msg=' . $msg);
?>

