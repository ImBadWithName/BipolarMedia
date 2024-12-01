<?php
//he
if(isset($_GET['Name'])){



    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query="Select Count(Id)!=0 as rep from User Where User.Nom=?;";

    $reqSub = $conn ->prepare($query);
    $res= $reqSub->execute([$_GET['Name']]);

    $row = $reqSub->fetchAll();

    if($row[0]['rep']!=0){
        echo"Ce nom est déjà utilisé, t'es vraiment pas original(e)";
    }
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
}