<?php
echo var_dump($_FILES);


if (isset($_FILES) && isset($_POST)) {
    echo "ca marche"."<br>";
    if($_FILES['Image']['tmp_name'] =="" ){
        echo "pas d'image sélectionner, Image par défaut";
        $imgData = file_get_contents("./img/jacquotles.gif");
        $imgType = 'image/gif';

    }
    else{
        $imgData = file_get_contents($_FILES['Image']['tmp_name']);
        $imgType = getimageSize($_FILES['Image']['tmp_name'])['mime'];
    }


    echo $imgType["mime"]."<br>";
    echo "Taille du fichier : " . $_FILES['Image']['size'] . "<br>";
    echo "Nom du Fichier : " . $_FILES['Image']['tmp_name'] . "<br>";
    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = "INSERT INTO User ( Nom, Bio, PP,PPtype, Psw) VALUES (?,?,?,?,?);";
    $reqSub = $conn->prepare($query);

    echo "Nom : ".$_POST["Nom"]."<br>";
    echo "Bio : ".$_POST["Bio"]."<br>";
    echo "Psw : ".$_POST["Psw"]."<br>";
    $pswcrypt = password_hash($_POST["Psw"],PASSWORD_DEFAULT) ;
    echo $pswcrypt;
    $neoNom = strip_tags($_POST["Nom"]);
    $neoBio = strip_tags($_POST["Bio"]);
    $res=$reqSub->execute([$neoNom,  $neoBio,$imgData,$imgType, $pswcrypt]);
    if(!$res){die('query failed : '.$query);}
    $conn->query('KILL CONNECTION_ID()');
    $conn = null;
    echo "ca marche";
    header("Location: ./feed.php");
    exit();
}
$a = 5;
if($a>10) {
    $a =5;
    $b=10;
    echo "glace";
    if(){

    }
}
else if() {

}
