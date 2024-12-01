<?php
?>  
<!DOCTYPE html>

<html lang="FR-fr">
<head>
    <title>popup</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/popup.css" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <script src="./js/popup.js"></script>
</head>
<body>
<div class="popup">
    <div class="mainform lightblue-background">
            <div class="grid-2">
                <div class="align-center">
                    <div class="preview darkblue-background">
                        <img class="img-preview" src="./img/bypolarmedia.png">
                    </div>
                </div>
                <form action="AddPostToDB.php" class="form align-center justify-center" method="post" enctype="multipart/form-data">
                    <div>
                        <div class="grid-4">
                            <div class="parent-div align-center">
                                <input type="file" name="Image" id="file" class="inputfile" accept=".jpg, .jpeg, .png, .gif" required/>
                                <label for="file">Choisissez une photo à publier</label>
                            </div>
                            <div class="align-center justify-end">
                                <div class="cross" id="cross"></div>
                            </div>
                        </div>
                        <div>
                            <input placeholder="Titre du post" type="text" id="Titre" name="Titre" class="input color-darkblue">
                        </div>
                        <div>
                            <textarea placeholder="Description du post" cols="40" rows="25" class="description color-darkblue" name="Bio"></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Publier" class="darkblue-background color-white button">
                        </div>
                    </div>
                </form>

            </div>
    </div>
</div>
</body>

</html>
