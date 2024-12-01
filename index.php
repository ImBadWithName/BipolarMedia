<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <p>Vous êtes connectez en temps que :  <?php echo $_SESSION["NomUser"];?></p>
    <a href="./addPost.php">Création de post</a> <br>
    <a href="./SelectPost.php">Voir les posts</a> <br>
    <a href="./AddUser.php">Création Utilisateur</a> <br>
    <a href="./Deconnexion.php">Déconnexion</a> <br>
    <?php
    header("Location: ./login.php");
    exit();
    ?>

</body>
</html>
