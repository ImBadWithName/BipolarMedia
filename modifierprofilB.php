<?php
session_start();
if (isset($_FILES) && isset($_POST)) {
    $query = "UPDATE User SET Nom = :nom ,Bio = :bio ";
    if($_POST["Psw"]!=""){
        $query .= ", Psw = :psw";
    }
    if($_FILES['Image']['tmp_name'] !=""){
        $query .= ", PPtype = :pptype ";
        $query .= ", PP = :pp";
    }
    $query.=" WHERE Id = :id ;";
    echo $query;
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $reqSub = $conn->prepare($query);
    $neoBio = strip_tags($_POST["Bio"]);
    $neoNom = strip_tags($_POST["Nom"]);
    $reqSub->bindParam(':nom',$neoNom);
    $reqSub->bindParam(':bio',$neoBio);

    if($_POST["Psw"]!=""){
        $neoPsw = password_hash($_POST['Psw'],PASSWORD_DEFAULT);
        $reqSub->bindParam(':psw',$neoPsw);
    }
    if($_FILES['Image']['tmp_name'] !=""){
        echo "ya une image";
        $imgData = file_get_contents($_FILES['Image']['tmp_name']);
        $imgType = getimageSize($_FILES['Image']['tmp_name']);

        $reqSub->bindParam(':pptype',$imgType["mime"]);
        $reqSub->bindParam(':pp',$imgData);
    }
    $reqSub->bindParam(':id',$_SESSION["IdUser"]);

    $reqSub->debugDumpParams();
    $res=$reqSub->execute();
    echo "<br>".var_dump($reqSub->errorInfo())."<br>";
    echo "le nom :".$_POST['Nom']."<br>";
    echo "la Bio :".$_POST['Bio']."<br>";
    echo "l'Id' :".$_SESSION["IdUser"]."<br>";





    echo "Taille du fichier : " . $_FILES['Image']['size'] . "<br>";
    echo "Nom du Fichier : " . $_FILES['Image']['tmp_name'] . "<br>";
    if(!$res){die('query failed : '.$query);}
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    echo "ca marche";
    header("Location: ./profil.php?UserId=".$_SESSION["IdUser"]);
    exit();
}
