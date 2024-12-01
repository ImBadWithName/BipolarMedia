function tri(facteur){

    if(facteur=="date"){
        var AllPost = document.querySelectorAll('.unpost');
        tinysort.defaults.order = 'desc';
        tinysort(AllPost,{data:'date'},{place:'org'});
    }
    if(facteur=="like"){
        var AllPost = document.querySelectorAll('.unpost');
        tinysort.defaults.order = 'desc';
        tinysort(AllPost,{data:'nombrelike'},{place:'org'});
    }
    if(facteur=="dislike"){
        var AllPost = document.querySelectorAll('.unpost');
        tinysort.defaults.order = 'desc';
        tinysort(AllPost,{data:'nombredislike'},{place:'org'});
    }
}

document.addEventListener('DOMContentLoaded', function (){


    var userId = document.getElementById('info_user').dataset.userid;
    const comments_sub = document.querySelectorAll('input');
    for(const item of comments_sub){
        item.addEventListener('click',function(){
            event.preventDefault();
            var comment_field = document.querySelector('[data-commentfield="'+item.dataset.commentsub+'"]');

            if(comment_field.value!=""){
                    let request =
                        $.ajax({
                            url:"./addComment.php",
                            type:"POST",
                            data:{
                                PostId : item.dataset.commentsub,
                                UserId : userId,
                                Content : comment_field.value
                            }
                        });
                    request.done (function (){
                        comment_field.value="";
                        const zone_comment = document.querySelectorAll('[data-com="'+item.dataset.commentsub+'"] .com');
                        const parent = document.querySelector('[data-com="'+item.dataset.commentsub+'"]');
                        for(const element of zone_comment) {
                                 parent.removeChild(element);
                            }
                        var xmlhttp2 = new XMLHttpRequest();
                        xmlhttp2.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {

                                parent.innerHTML += this.responseText;
                            }
                        }
                        xmlhttp2.open("GET","./afficheComment.php?PostId="+item.dataset.commentsub,true);
                        xmlhttp2.send();
                    });
                }
        });
    }
});

let lebouton = document.getElementById("lebouton");
let tadam = document.getElementById("tadam");
lebouton.addEventListener("click", () => {
    if(getComputedStyle(tadam).display != "none"){
        tadam.style.display = "none";
    } else {
        tadam.style.display = "block";
    }
})
