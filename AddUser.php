<?php  ?>
<form action="./AddUserToDB.php" method="post" enctype="multipart/form-data">
    <label for="Nom">Votre Pseudo</label>
    <input type="text" name="Nom" id="Nom" required>
    <label for="Psw">Ton Mot de passe</label>
    <input type="password" name="Psw" id="Psw" required>
    <label for="Bio">Ta Bio</label>
    <textarea name="Bio" id="Bio"> Votre Bio ici</textarea>
    <label for="Image">Image de Profil</label>
    <input type="file" name="Image" id="Image">
    <input type="submit" value="Valider">
</form>
