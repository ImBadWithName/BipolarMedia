document.addEventListener('DOMContentLoaded', function () {
    const allLikes = document.querySelectorAll(".like, .liked");
    for(const like of allLikes){
        like.addEventListener('click',function (){
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function (){
                if (this.readyState == 4 && this.status == 200) {
                    var nbrcount =like.parentNode.previousElementSibling;
                    if(like.classList.contains('liked')){
                        nbrcount.innerHTML= parseInt(nbrcount.innerHTML)-1;
                        like.classList.toggle('liked');
                        like.classList.toggle('like');
                    }
                    else {
                        nbrcount.innerHTML= parseInt(nbrcount.innerHTML)+1;
                        like.classList.toggle('liked');
                        like.classList.toggle('like');
                    }
                }
            };
            var userId = document.getElementById('info_user').dataset.userid;
            if(like.classList.contains('dislike')){
                var value = 1;
            }
            else {
                var value = 0;
            }

            xmlhttp.open("GET","./AddLike.php?PostId="+like.dataset.postid+"&UserId="+userId+"&Value="+value,true);
            xmlhttp.send();
        });
    };
});