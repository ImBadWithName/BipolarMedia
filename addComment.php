<?php
echo "Utilisateur : ".$_POST['UserId']."<br>";
echo "Post : ".$_POST['PostId']."<br>";
session_start();
if(isset($_POST['PostId'])){
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }

        $query = "INSERT INTO `Commentaire` (`UserId`, `PostId`,`Content` ) VALUES (:UserId, :PostId, :Content);";

        $reqSub = $conn ->prepare($query);
        $reqSub->bindParam(':UserId',$_POST['UserId']);
        $reqSub->bindParam(':PostId',$_POST['PostId']);
        $neoContent =  strip_tags($_POST['Content'],'<br><a><b><i>');
        $reqSub->bindParam(':Content',$neoContent);
        $res= $reqSub->execute();
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
}
