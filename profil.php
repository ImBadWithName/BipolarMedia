<?php
session_start();
$num_post_profil = 0;
    if(isset($_GET['UserId'])){
        echo "cool";
        require_once 'config.php';
        try {
            $conn = new PDO(DB, USER, PWD);
        } catch (PDOException $e) {
            die ("Failed: " . $e);
        }
        $query = 'SELECT Nom,Bio,PP,PPtype FROM User WHERE Id = ? ;';
        $reqsub = $conn->prepare($query);
        $res = $reqsub->execute([$_GET['UserId']]);
        if (!$res) die ("Failed query : " . $query);
        $row = $reqsub->fetchAll();
        $pseudo = $row[0]["Nom"];
        $bio = $row[0]["Bio"];

    }
?>
<!DOCTYPE html>

<html lang="FR-fr">
	<head>
		<title>page profil utilisateur</title>

		<meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="./css/profil.css" />
        <link rel="stylesheet" type="text/css" href="./css/feed.css" />
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
        <script src="./js/deletePost.js"></script>
        <script src="./lib/js/jquery-3.6.0.min.js"></script>
	</head>
	<body>
    <?php include('header.php'); ?>
        <div class="space-5"></div>
        <main>
            <div class="grid-2 infos">
                <div class="justify-center">
                    <div class="rond justify-center">
                        <img src="./ImageView.php?ImageId=<?php echo $_GET['UserId'];?>&req=User" alt="photo de profil" class="PP justify-center">
                    </div>

                    <div class="justify-center align-center">

                        <h1 id="profil-name" ><?php echo $pseudo;?></h1>
                        <?php if($_GET["UserId"]==$_SESSION["IdUser"]):?>
                        <a href="modifierprofil.php">
                        <img src="./img/iconemodifier.png" alt="icone modifier" class="iconemodifier" >
                        </a>
                        <?php endif;?>
                    </div>

                </div>
                <div class="align-center justify-center">
                    <p id="bio" class="align-center justify-center"> <?php echo $bio;?></p>
                </div>
            </div>

            <div class="space-5"></div>
            <?php
            echo "<div hidden id ='info_user' data-userid='".$_SESSION["IdUser"]."' data-userpsw='".$_SESSION["Psw"]."'></div>";
            $query = 'SELECT Titre, Post.Bio,Post.Id ,CreateurId,Nom,Date,
       SUM(CASE WHEN Likes.IsLiked=1 THEN 1 ELSE 0 END) as nbr_likes,
       SUM(CASE WHEN Likes.IsDisliked=1 THEN 1 ELSE 0 END) as nbr_dislikes,
       SUM(CASE WHEN Likes.UserId= ? and Likes.Isliked=1 THEN 1 ELSE 0  END)as UserLiked,
    SUM(CASE WHEN Likes.UserId= ? and Likes.IsDisliked=1 THEN 1 ELSE 0 END)as UserDisliked
    from Post LEFT JOIN Likes ON Post.Id =PostId 
    LEFT JOIN User ON User.Id = CreateurId
    WHERE CreateurId = ?
    Group By Post.id
    Order By Post.Date Desc;';

            $reqsub = $conn->prepare($query);
            $res = $reqsub->execute([$_SESSION["IdUser"],$_SESSION["IdUser"],$_GET["UserId"]]);

            $row = $reqsub->fetchAll();
            //var_dump($reqsub->errorInfo());

            if (!$res) die ("Failed query : " . $query);



            foreach ($row as $item):?>
                <article class="">
                    <main class="lightblue-background post" id='<?php echo "post_num".$num_post ; $num_post ++;?>'>
                        <header>

                            <div class="profil-picture">
                                <a href="https://b3.gremmi.fr/profil.php?UserId=<?php echo $item["CreateurId"] ; ?>">
                                    <img src="./ImageView.php?ImageId=<?php echo $item["CreateurId"] ; ?>&req=User">
                                </a>
                            </div>
                            <div>
                                <a class="color-darkblue" href="https://b3.gremmi.fr/profil.php?UserId=<?php echo $item["CreateurId"] ; ?>">
                                    <h2 class="post-pseudo"><?php echo $item["Nom"] ; ?></h2>
                                </a>
                            </div>
                            <div class="jojo align-center justify-end color-darkblue">
                                <h3 class="post-titre"><?php echo $item["Titre"]; ?></h3>
                            </div>

                        </header>
                        <main>
                            <img loading="lazy" class="main-img-post" src="./ImageView.php?ImageId=<?php echo $item['Id'];?>&req=Post">
                        </main>
                        <footer>
                            <div class="align-center big-like">
                                <div data-nbrid ="<?php echo $item["Id"];?>"><?php echo $item["nbr_likes"];?></div>
                                <div class="div-sup-like">
                                    <div class="<?php if(boolval($item["UserLiked"])){echo "liked";}else{echo "like";};?>" data-postid="<?php echo $item["Id"];?>"></div>
                                </div>
                            </div>
                            <div class="align-center big-like">
                                <div data-nbrid ="<?php echo $item["Id"];?>"><?php echo $item["nbr_dislikes"];?></div>
                                <div class="div-sup-dislike">
                                    <div class="<?php if(boolval($item["UserDisliked"])){echo "liked";}else{echo "like";};?> dislike" data-postid="<?php echo $item["Id"];?>"></div>
                                </div>
                            </div>
                            <?php  if($_SESSION["IdUser"]==$_GET["UserId"]): ?>
                            <div  class="align-center img-delete ">
                                <a  class="lightblue-background color-lightblue justify-end" id="<?php echo $num_post_profil;  ?>"  href="deletePost.php?PostId=<?php echo $item["Id"];?>">
                                    <img src="./img/Iconepoubelle.png" alt="bouton suppression post"  >
                                </a>
                            </div>
                            <?php endif; ?>
                        </footer>

                    </main>

                    <aside class="lightblue-background">
                        <div class="aside" data-com = "<?php echo $item["Id"]; ?>">
                            <?php if($item["Bio"]!=null):?>
                                <div class="bio">
                                    <div class="bio-title align-center">
                                        <h4><?php echo $item["Nom"] ; ?></h4>
                                    </div>
                                    <div class="grey-stick-bio"></div>
                                    <div>
                                        <p><span>Bio : </span><?php echo $item["Bio"];?></p>
                                    </div>
                                </div>
                            <?php endif;
                            $query ="select UserId, Content, Nom From Commentaire Join User on User.Id = UserId Where PostId= ? Order By Commentaire.Id Desc";
                            $reqsub = $conn->prepare($query);

                            $res = $reqsub->execute([$item["Id"]]);

                            if (!$res) die ("Failed query : " . $query);
                            $comments = $reqsub->fetchAll();

                            foreach ($comments as $comment):
                                ?>


                                <div class="com">
                                    <a href="https://b3.gremmi.fr/profil.php?PostId=<?php echo $comment["UserId"] ; ?>">

                                        <div class="com-title align-center">
                                            <img loading="lazy" src="./ImageView.php?ImageId=<?php echo $comment["UserId"]; ?>&req=User">
                                            <h4 class="color-darkblue"><?php echo $comment["Nom"]; ?></h4>

                                        </div>
                                    </a>
                                    <div class="grey-stick-com"></div>
                                    <div class="com-text">
                                        <p><?php echo $comment["Content"]; ?></p>
                                    </div>
                                </div>
                                <div class="grey-stick-aside"></div>
                            <?php endforeach;?>

                        </div>
                        <div class="align-center ajout-com">
                            <div class="button-show-com">
                                <img src="./img/Boutonpost.png" alt="bouton pour ajouter des commentaire">
                            </div>
                            <form class="form-ajout-com align-center">
                                <textarea data-commentfield = "<?php echo $item["Id"];?>" maxlength="255" placeholder="Commentaire" name="commentaire" cols="25" rows="2" class="color-darkblue"></textarea>
                                <input data-commentsub = "<?php echo $item["Id"];?>" type="submit" value="poster" class="color-darkblue lightblue-background">
                            </form>
                        </div>
                    </aside>

                </article>

            <?php endforeach;
            $conn->query('KILL CONNECTION_ID()');
            $conn = null;
            ?>
        </main>

	</body>
    <script src="./js/SelectPost.js"></script>
</html>
