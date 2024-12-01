<?php
session_start();
if (isset($_SESSION['IdUser'])) {

    require_once 'config.php';
    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die ("Failed: " . $e);
    }
    $query = 'SELECT Nom,Bio FROM User WHERE Id = ?;';
    $reqsub = $conn ->prepare($query);
    $res = $reqsub->execute([$_SESSION['IdUser']]);
    if (!$res) die ("Failed query : " . $query);
    $conn->query('KILL CONNECTION_ID()');
    $row = $reqsub->fetchAll();
    $pseudo = $row[0]["Nom"];
    $bio = $row[0]["Bio"];
    $conn = null;
}

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
        <form action="modifierprofilB.php" class="form align-center justify-center" method="post" enctype="multipart/form-data">
            <div class="grid-2 smallform">
                <div class="right-form ">
                    <input value="<?php echo $pseudo;?>" autocomplete="off" required ="text" id="nom" name="Nom" class="input color-darkblue" onKeyUp="CheckNom(this)">
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
                    <input placeholder="Nouveau mot de passe" autocomplete="off" type="password" id="psw" name="Psw" class="input color-darkblue" onKeyUp="compare()">
                    <input placeholder="Confirmation du nouveau mot de passe" autocomplete="off" type="password" id="pswbis" name="Pswbis" class="input color-darkblue" onKeyUp="compare()">
                    <p class="error" id="error-msg"> </p>

                </div>
                <div>
                    <div class="grid-2">
                        <div class="preview darkblue-background"><img class="img-preview" src="./ImageView.php?ImageId=<?php echo $_SESSION['IdUser'];?>&req=User"></div>
                        <div class="parent-div align-center">
                            <input type="file" name="Image" id="file" class="inputfile" accept=".jpg, .jpeg, .png, .gif"/>
                            <label for="file">Changez votre photo de profil</label>
                        </div>
                    </div>
                    <div >
                        <textarea name="Bio" cols="40" rows="25" class="bio color-darkblue"><?php echo $bio;?></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" id="submit" value="Modifier" class="darkblue-background color-white button" onclick="validation(event)">
        </form>
        <div class="conditions">
            <p>En vous inscrivant sur Bypolar Media vous acceptez nos<a href="unpdfvide.pdf" class="pdfvide"> <strong>Conditions d'utilisation</strong></a> que vous ne
                pouvez pas lire parce que le lien ne renvoie vers rien mais vu que personne ne lit jamais les conditions ce n'est pas grave. </p>
        </div>
    </div>
</div>
</body>
<script src="./js/modifierprofil.js"></script>
</html>
