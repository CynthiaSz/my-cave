<?php
 include 'connect.php';

// définit un mot de passe crypté par un algorythme  
$pass_hache = sha1($_POST['password']);
$login = $_POST['login'];
 
//le sauvegarde dans base de données ainsi que le login saisi
$req = $bdd->prepare('SELECT id FROM users WHERE login = :loginREQ AND password = :passwordREQ');
$req->execute(array(
	'loginREQ'	 =>$login,
	'passwordREQ'=>$pass_hache
	));

$result = $req->fetch();

// si le login ou le mot de passe est faux, un message apparait et l'utilisateur reste sur la page index.php
// sinon, il est redirigé vers la page references
if (!$result) {
	echo 'sorry the login or the password is false';
	header('Location: index.php?msg=Login or password incorrect');
} else {
	session_start();
	$_SESSION['id'] = $result['id'];
	$_SESSION['pseudo'] = $login;
	$_SESSION['authentified'] = true;
	header('Location: references.php');
}
