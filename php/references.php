<?php

session_start();

//si $_SESSION est nul ou si sa valeur est fausse, celà renvoie vers la page 'forbidden' avec un message "Erreur 403"
if(!isset($_SESSION['authentified']) || !$_SESSION['authentified']){
    header('HTTP/1.0 403 Forbidden');
    echo "Error 403 : Unauthorized Access<br/> <a href=\"index.php\">Return</a>";
    return;
}
 

include 'header.php' ?>

<body class="cellar">

    <img class="logo" src="img/logo.png">

    <h1 class="ref">References</h1>

    <nav>
        <!-- label associé à l'input -->
        <label for=add>Add</label>
        <label for="disconnect"><a class="bye" href="index.php">Disconnect</a></label>
    </nav>

    <div class="box">
        <!--bouton radio de base-->
        <input type=radio name=box id=none>
  
        <div class="box">
            <!-- bouton radio au clic -->
            <input type=radio name=box id=add>
            <!-- formulaire -->
            <form action="add_post.php" method="post" enctype="multipart/form-data">
                <h3>Add</h3>
                <label for=none>X</label>
                <input type="text" placeholder="Name..." name="name"/>
                <input type="text" placeholder="Year..." name="year"/>
                <input type="text" placeholder="Grapes..." name="grapes"/>
                <input type="text" placeholder="Country..." name="country"/>
                <input type="text" placeholder="Region..." name="region"/>
                <input type="textarea" placeholder="Description..." name="description"/>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input type="file" name="picture" id="picture" required="true"/>
                <input type=submit value="submit" name="upload" />
            </form>
        </div><!-- fin box -->

    </div><!-- fin box1 -->
   

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

                <div class="action">
                    <label class="button1" for="edit-<?php echo $data['id']; ?>">Edit</label>

                    <a class="button2" href="delete.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Are you absolutely sure you want to delete ?')">Delete</a>
                </div>

                <img src="img/<?php echo $data['picture']?>" alt="bottles">
                <p>Name : <?php echo $data['name'] ?></p>
                <p>Year : <?php echo $data['year'] ?></p>
                <p>Grapes : <?php echo $data['grapes'] ?></p>
                <p>Country : <?php echo $data['country'] ?></p>
                <p>Region : <?php echo $data['region'] ?></p>
                <p>Description : <?php echo $data['description'] ?></p>

            </div><!-- fin bottleRef -->

        <div class="box">
            <!--bouton radio de base-->
            <input type=radio name=box id="edit-<?php echo $data['id']; ?>"/>
            <!-- formulaire de modification -->
            <form action="edit_post.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
                <h3>Edit</h3>
                <label for=none>X</label>
                <input type="text" name="name" placeholder="name" value="<?php echo $data['name']; ?>"/>
                <input type="text" name="year" placeholder="year" value="<?php echo $data['year']; ?>"/>
                <input type="text" name="grapes" placeholder="grapes" value="<?php echo $data['grapes']; ?>"/>
                <input type="text" name="country" placeholder="country" value="<?php echo $data['country']; ?>"/>
                <input type="text" name="region" placeholder="region" value="<?php echo $data['region']; ?>"/>
                <input type="textarea" name="description" placeholder="Description..." value="<?php echo $data['description']; ?>"/>
                <input type="file" name="picture"/>
                <input type="submit"/>
            </form>
        </div><!-- fin box -->

<?php  
}
?>

        </div><!-- fin bottleList -->

    </div><!-- fin list -->

   
<?php include 'footer.php' ?>

</body>
