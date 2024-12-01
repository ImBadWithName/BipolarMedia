<?php
echo "Utilisateur : ".$_GET['UserId']."<br>";
echo "Post : ".$_GET['PostId']."<br>"; 
session_start();
if(isset($_GET['PostId'])){
    if($_GET['Value']=="0"){
        $reqval = "IsLiked";
    }
    else{
        $reqval = "IsDisliked";
    }
    echo "l'utilisateur veut : ". $reqval ."<br>";
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query="Select Count(Id)!=0 as rep from Likes Where Likes.UserId=? and Likes.PostId=?;";
    $reqSub= $conn->prepare($query);
    $res = $reqSub->execute([$_GET['UserId'],$_GET['PostId']]);

    $row = $reqSub->fetchAll();
    echo var_dump($row)."<br>";
    if($row[0]['rep']=="0"){
        echo "le like n'existe pas"."<br>";
        $query = "INSERT INTO `Likes` (`PostId`, `UserId`, ".$reqval.") VALUES (?, ?, 1);";
        echo $query."<br>";
        $reqSub = $conn ->prepare($query);
        echo $_GET['PostId']."<br>";
        $res= $reqSub->execute([$_GET['PostId'],$_GET['UserId']]);
        echo var_dump($res)."<br>";

    }
    else{
        echo "le like existe"."<br>";
        $query ='Update Likes SET '.$reqval.' = NOT '.$reqval.' Where Likes.UserId=? and Likes.PostId=?;';
        $reqSub = $conn ->prepare($query);
        $res= $reqSub->execute([$_GET['UserId'],$_GET['PostId']]);
        echo $query."<br>";
        echo var_dump($res)."<br>";
    }
    //$res = $conn->query($query);
    //if (!$res) die ("Failed query : " . $query);

    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
}