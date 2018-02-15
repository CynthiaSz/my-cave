<?php 

include 'header.php' ?>

<body class="cellar">

  <form>
    <input type="button" value="Retour" name="Retour" class="retour" onclick="history.go(-1)">
  </form>


	<nav>
    <!-- label associé à l'input -->
    <label for=login>Login</label>
  </nav>

  <img class="logo" src="img/logo-large.png">

  <div class="box">
    <!--bouton radio de base-->
    <input type=radio name=box id=none>
  
      <div class="box">
        <!-- bouton radio au clic -->
        <input type=radio name=box id=login>
        <!-- formulaire connexion -->
        <form action="login_post.php" method="post">
          <h3>Login</h3>
          <label for=none>X</label>
          <input placeholder="Login..." name="login">
          <input type=password placeholder="Password..." name="password">
          <input type=submit value="submit">
        </form>
      </div><!-- fin box -->

<!-- si login et mot de passe bons, connexion, sinon, pas connexion -->
<?php
if (isset($_GET['login'])) {
	  echo $_GET['login'];
}
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'disconnect') {
    session_start();
    session_destroy();
} 
?>

	<div class="list">

        <div class="bottleList"> 
  
<!--Cela affiche les données contenues dans la partie bouteille de la base de données-->
<?php  
$responseBrut = $bdd->query('SELECT * FROM bottles');
?> 
    
<!--tant que la base de données renvoie une réponse -->
<?php
while ($data = $responseBrut->fetch())
{
?>

<div class='bottleRef'>

                <img src="img/<?php echo $data['picture']?>" alt="bottles">
                <p>Name : <?php echo $data['name'] ?></p>
                <p>Year : <?php echo $data['year'] ?></p>
                <p>Grapes : <?php echo $data['grapes'] ?></p>
                <p>Country : <?php echo $data['country'] ?></p>
                <p>Region : <?php echo $data['region'] ?></p>
                <p>Description : <?php echo $data['description'] ?></p>

            </div><!-- fin bottleRef -->
<?php  
}
?>

<?php include 'footer.php' ?>

</body>
