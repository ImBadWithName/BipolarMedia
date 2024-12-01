<?php
session_start();
$num_post = 0;
require_once 'config.php';
try {
    $conn = new PDO(DB, USER, PWD);
} catch (PDOException $e) {
    die ("Failed: " . $e);
}
$query ="select UserId, Content, Nom From Commentaire Join User on User.Id = UserId Where PostId= ? Order By Commentaire.Id Desc";
$reqsub = $conn->prepare($query);

$res = $reqsub->execute([$_GET["PostId"]]);

if (!$res) die ("Failed query : " . $query);
  $comments = $reqsub->fetchAll();
                foreach ($comments as $comment):
                ?>

                <div class="grey-stick-aside darkblue-background"></div>
                <div class="com">
                    <div class="com-title align-center">
                        <a href="https://b3.gremmi.fr/profil.php?UserId=<?php echo $comment["UserId"] ; ?>">
                            <img src="./ImageView.php?ImageId=<?php echo $comment["UserId"]; ?>&req=User">
                            <h4><?php echo $comment["Nom"]; ?></h4>
                        </a>
                    </div>
                    <div class="grey-stick-com"></div>
                    <div class="com-text">
                        <p><?php echo $comment["Content"]; ?></p>
                    </div>
                </div>
                <?php endforeach;?>