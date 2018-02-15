<?php
session_start();

require 'connect.php';

//si $_FILES contient un élément, 
// $folder = le résultat que je trouve avec le chemin absolu (ici, sortie du dossier php puis entrée dans img)
// $file = (basename retourne le nom de la composante finale du chemin) de $_FILES['picture']['name']
if (!empty($_FILES['picture']['name'])) {
        $folder = realpath('../img').'/';
        $file = basename($_FILES['picture']['name']);

	//Pour déplacer $_FILES du dossier temporaire vers le dossier img s'il est valide
	//Si il s'est déplacé, la fonction retourne "success", sinon, elle retourne "error"
	if (move_uploaded_file($_FILES['picture']['tmp_name'], $folder . $file)) {
        echo "success !";
	} else {
        echo "error";
	}

//la requête préparée préselectionne les données déjà fournies
$req = $bdd->prepare('UPDATE bottles SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture WHERE id = :id');

// et les remplace par les nouvelles
$req->execute(array(
	'name'		   =>$_POST ['name'],
	'year'		   =>$_POST ['year'],
	'grapes'	   =>$_POST ['grapes'],
	'country'	   =>$_POST ['country'],
	'region'	   =>$_POST ['region'],
	'description'  =>$_POST ['description'],
	'picture'	   =>$_FILES['picture']['name'],
	'id'		   =>$_GET  ['id']
	));

} else {
//sinon, la requête préselectionne les données déjà fournies 
$req = $bdd->prepare('UPDATE bottles SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description WHERE id = :id');

// et remplace les champs vides par les données déjà fournies
$req->execute(array(
	'name'			=>$_POST['name'],
	'year'			=>$_POST['year'],
	'grapes'		=>$_POST['grapes'],
	'country'		=>$_POST['country'],
	'region'		=>$_POST['region'],
	'description'	=>$_POST['description'],
	'id'			=>$_GET['id']
	));

}

$msg = 'Bottle changed';

header('Location: references.php?msg=' . $msg);
