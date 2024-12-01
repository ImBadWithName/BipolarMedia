<?php
?>
<!DOCTYPE html>

<html lang="FR-fr">
<head>
    <title>register</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/register.css" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
<div class="register">
    <div class="mainform lightblue-background">
        <div class="justify-center">
            <img src="./img/bypolarmedia.png" id="logo" alt="logo textuel bypolar media">
        </div>
        <form action="AddUserToDB.php" class="form align-center justify-center" method="post" enctype="multipart/form-data">
            <div class="grid-2 smallform">
                <div class="right-form ">
                <input placeholder="Nom d'utilisateur" required ="text" id="nom" name="Nom" class="input color-darkblue" onKeyUp="CheckNom(this)">
                        <select name="signeastro" id="signe" name="Signe" class="input color-darkblue">
                        <option selected disabled>Signe astrologique</option>
                        <option value="b">Bélier</option>
                        <option value="t">Taureau</option>
                        <option value="g">Gémeaux</option>
                        <option value="c">Cancer</option>
                        <option value="l">Lion</option>
                        <option value="v">Vierge</option>
                        <option value="ba">Balance</option>
                        <option value="s">Scorpion</option>
                        <option value="sa">Sagittaire</option>
                        <option value="ca">Capricorne</option>
                        <option value="ve">Verseau</option>
                        <option value="p">Poisson</option>
                        </select>
                <input placeholder="Mot de passe" required type="password" id="psw" name="Psw" class="input color-darkblue" onKeyUp="compare()">
                <input placeholder="Confirmation mot de passe" required type="password" id="pswbis" name="Pswbis" class="input color-darkblue" onKeyUp="compare()">
                    <p class="error" id="error-msg"> </p>

            </div>
                <div>
                    <div class="grid-2">
                        <div class="preview darkblue-background"><img class="img-preview" src="#"></div>
                        <div class="parent-div align-center">
                            <input type="file" name="Image" id="file" class="inputfile" accept=".jpg, .jpeg, .png, .gif"/>
                            <label for="file">Choisissez une photo de profil</label>
                        </div>
                    </div>
                    <div >
                        <textarea placeholder="Bio" name="Bio" cols="40" rows="25" class="bio color-darkblue"></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" id="submit" value="Suivant" class="darkblue-background color-white button" onclick="validation(event)">
        </form>
            <div class="conditions">
                <p>En vous inscrivant sur Bypolar Media vous acceptez nos<a href="./PDFs/CUG.pdf" class="pdfvide"> <strong>Conditions d'utilisation</strong></a> que vous ne
                pouvez pas lire parce que le lien ne renvoie vers rien mais vu que personne ne lit jamais les conditions ce n'est pas grave. </p>
            </div>
    </div>
</div>
</body>
<script src="./js/register.js"></script>
</html>
