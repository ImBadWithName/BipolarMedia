<?php
if($_GET["ImageId"]!=null) {
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }

    if($_GET["req"]=="Post"){
        $query = 'SELECT Image as Image, TypeImage as TypeImage FROM Post WHERE Id = ?;';
    }
    if($_GET["req"]=="User"){
        $query = 'SELECT PP as Image , PPtype as TypeImage FROM User WHERE Id = ?;';
    }
    $reqsub = $conn->prepare($query);
    $res = $reqsub ->execute([$_GET["ImageId"]]);
    if (!$res) die ("Failed query : " . $query);
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    $row = $reqsub->fetchAll();
    //echo "Content-type: " . $row[0]['TypeImage'];
    header("Content-type: " . $row[0]['TypeImage']);
    echo $row[0]['Image'];
}

?>