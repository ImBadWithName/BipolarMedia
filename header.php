<?php
session_start();
if(!isset($_SESSION['IdUser'])){
    header("Location: ./login.php");
    exit();
}
?>
<!DOCTYPE html>
 
<html lang="FR-fr">
	<head>
		<title>Bypolar Media : the futur of social media</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./css/header.css" />
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
        <link rel="icon" type="image/png" sizes="16x16" href="./img/LogoBypolar.png" >
        

	</head>
	<body>
    <header id="header-background"  class="lightblue-background">
		<div id="header" class="lightblue-background">
            <div class="align-center justify-end">
                <a href="feed.php"> <img id="logo" src="./img/bypolarmedia.png" alt="le logo"></a>
            </div>
            <div id="header-centre" class="align-center justify-space-around " >
                <div class="align-center">
                    <ul class="menu-accordeon">
                        <li><a href="#">Trier par</a>
                            <ul>
                                <li><a href="#" onclick="tri('date')">Les plus récents</a></li>
                                <li><a href="#" onclick="tri('like')">Les plus likés</a></li>
                                <li><a href="#" onclick="tri('dislike')">Les plus dislikés</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
               
                <div class="open-btn ">
                    <button id="open-button" class="open-button color-lightblue lightblue-background" ><img class="boutonajoutpost align-center" src="./img/Boutonpost.png" alt="bouton ajout post"></button>
                </div>
            <!--remplir ici avec le code php-->
                <div>
                    <a href="./Deconnexion.php" class="color-darkblue"><img class="deconnexion-logo" src="./img/deconnexion.png"></a>
                </div>
            </div>

            <div class="justify-start align-center pp-header">
                <a href="./profil.php?UserId=<?php echo $_SESSION["IdUser"] ; ?>">
                <img class="profil-picture-header" src="./ImageView.php?ImageId=<?php echo $_SESSION['IdUser'];?>&req=User" alt="photo de profil">
                </a>
            </div>
        </div>
    </header>
	</body>
    <script src="./js/creation-post.js"></script>
</html>

