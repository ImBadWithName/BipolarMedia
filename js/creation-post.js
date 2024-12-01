document.addEventListener('DOMContentLoaded', function (){
    var openbutton = document.getElementById('open-button');

    function addElement () {
        console.log('le click fonctione');


        var creation_post = new XMLHttpRequest();

        creation_post.onreadystatechange = function (){
            if (this.readyState == 4 && this.status == 200) {

                const div = document.createElement("div");
                div.innerHTML = creation_post.responseText;
                document.body.appendChild(div);
                div.classList.add("new-window");


                const cross = document.getElementById('cross');
                function close () {

                    div.remove();

                }
                const inputImage = document.getElementById("file");
                const displayImage = document.querySelector(".img-preview");
                function preview_img () {
                    const [imagefile] = inputImage.files
                    if(imagefile){
                        displayImage.src = URL.createObjectURL(imagefile);
                    }
                };
                inputImage.addEventListener('change', preview_img);
                cross.addEventListener('click', close);
            }
            else {

            }

        };
        creation_post.open("POST","./popup.php",true);
        creation_post.send();





    }


    openbutton.addEventListener('click', addElement);



});
