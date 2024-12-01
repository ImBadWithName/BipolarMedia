<?php
    session_start();
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = 'SELECT Titre, Bio,Post.Id , Count(Likes.Id) as nbr_likes
from Post LEFT JOIN Likes ON Post.Id =PostId
Group By Post.id';

    $res = $conn->query($query);
    if (!$res) die ("Failed query : " . $query);
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    $row = $res->fetchAll();
    echo "<div hidden id ='info_user' data-userid='".$_SESSION["IdUser"]."'></div>";
foreach ($row as $item) {
    echo '<h2>'.$item['Titre'].'</h2>';
    echo "<br>";
    echo $item['Bio'];
    echo "<br>";
    echo "<img src='./ImageView.php?ImageId=".$item['Id']."&req=Post'><br>";
    echo 'Nombre de like(s) : <span data-nbrid ="'.$item["Id"].'">'.$item['nbr_likes'].'</span> <a class="like" data-postid="'.$item["Id"].'">Ajouter un Like<a>';
    }
?>
    <script src="./SelectPost.js"></script>
