function delete_post(id_post_profil){
    let button_delete = document.getElementById(id_post_profil);

    console.log(button_delete);
    let post = button_delete.parentNode.parentNode.parentNode.parentNode;
    console.log(post)
    var userId = document.getElementById('info_user').dataset.userid;
    var psw = document.getElementById('info_user').dataset.userpsw;
    var postId = button_delete.dataset.id;
    console.log("User id : "+userId+" psw : "+psw+" post id : "+postId);
    let request =
        $.ajax({
            url:"../deletePost.php",
            type:"POST",
            data:{
                PostId : postId ,
                UserId : userId,
                Psw : psw
            }
        });
    request.done (function (){
        post.remove();});

};