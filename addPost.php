<?php echo'yep'; ?>
<form action="./AddPostToDB.php" method="post" enctype="multipart/form-data">

    <label for="Titre">Titre du post</label>
    <input type="text" name="Titre" id="Titre">
    <label for="Bio">Bio du post</label>
    <input type="text" name="Bio" id="Bio">
    <label for="CreateurId">Id Créateur du post</label>
    <input type="number" name="CreateurId" id="CreateurId">
    <label for="Image">Image du post</label>
    <input type="file" name="Image" id="Image">
    <input type="submit" value="Publier">
</form>
