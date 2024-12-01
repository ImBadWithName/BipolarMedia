<?php
session_start();
if(isset($_GET['PostId'])){
    echo "ca marche 1";
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }

    $query="select CreateurId as ci from Post where Id = ?;";
    $reqSub= $conn->prepare($query);

    $res = $reqSub->execute([$_GET['PostId']]);
    $row = $reqSub->fetchAll();

    echo var_dump($_SESSION["IdUser"]);
    if($_SESSION["IdUser"] == $row[0]["ci"] ){
        echo 'ca marche';
        $query = "DELETE FROM `Post` Where Id =?;";
        $reqSub = $conn ->prepare($query);
        $res= $reqSub->execute([$_GET['PostId']]);
    }
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    header("Location: ./profil.php?UserId=".$_SESSION["IdUser"]);
    exit();
}?>