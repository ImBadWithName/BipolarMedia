<?php
session_start();
$error_msg = "";
if(isset($_SESSION['IdUser'])){
    header("Location: ./feed.php");
    exit();
}
if(isset($_POST['Nom'])){

    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = 'SELECT Psw, Id FROM User WHERE Nom = ?;';
    $reqSub = $conn->prepare($query);
    $res=$reqSub->execute([$_POST['Nom']]);
    $conn->query('KILL CONNECTION_ID()');
    if (!$res) {//si la requête échoue, cela veut dire le pseudo rentré est incorrect

    }
    else{

        $row = $reqSub->fetchAll();
        if(isset($row[0]['Psw'])){
            if (password_verify($_POST["Psw"], $row[0]['Psw'])) {
                $_SESSION["IdUser"] = $row[0]['Id'];
                $_SESSION["NomUser"] = $_POST['Nom'];
                $_SESSION["Psw"] = $_POST['Psw'];
                header("Location: ./feed.php");
                exit();

            } else {
                $error_msg = "Mot de passe incorrect";
            }
        }
        else{
            $error_msg = "Nom d'utilisateur incorrect";
        }
    }
}
?>
<!DOCTYPE html>

<html lang="FR-fr">
<head>
    <title>login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <script src="./js/login.js"></script>
</head>
<body>
<div class="login">
    <div class="mainform lightblue-background">
        <div class="justify-center">
          <img src="./img/bypolarmedia.png" id="logo" alt="logo textuel bypolar media">
        </div>
        <form action="login.php" class="form align-center justify-center" method="post">
            <input placeholder="Nom d'utilisateur" type="text" id="Nom" name="Nom" class="input color-darkblue">
            <input placeholder="Mot de passe" type="password" id="Psw" name="Psw" class="input color-darkblue">
            <input type="submit" value="Se connecter" class="input darkblue-background color-white button">
            <p class="error bold"><?php echo $error_msg; ?></p>
        </form>
    </div>
    <div class="register lightblue-background justify-center align-center">
        <p  class="bold">Vous n'avez pas de compte ?</p>
        <a href="register.php" class="color-darkblue bold">Inscrivez-vous !</a>
    </div>
</div>

</body>
</html>
