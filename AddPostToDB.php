<?php
session_start();
echo "ca marche";
if($_FILES>0 && $_POST>0){
    $imgData = file_get_contents($_FILES['Image']['tmp_name']);
    $imgType  = getimageSize($_FILES['Image']['tmp_name']);

    echo $imgType["mime"];
    echo "Taille du fichier : ".$_FILES['Image']['size']."<br>";
    echo "Nom du Fichier : ".$_FILES['Image']['tmp_name']."<br>";
    echo "Titre du post : ".$_POST["Titre"]."<br>";
    echo "Bio du post : ".$_POST["Bio"]."<br>";
    echo "Utilisateur : ".$_SESSION["IdUser"]."<br>";
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = "INSERT INTO Post (Titre, Image, Bio, CreateurId, TypeImage, Date) VALUES (?,?,?,?,?,now());";
    $reqSub = $conn ->prepare($query);
    $neoBio = strip_tags($_POST["Bio"]);
    $neoTitre = strip_tags($_POST["Titre"]);
    $reqSub->execute([$neoTitre,$imgData,$neoBio,$_SESSION["IdUser"],$imgType["mime"]]);
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    echo "ca marche";
    header("Location: ./feed.php");
    exit();
}