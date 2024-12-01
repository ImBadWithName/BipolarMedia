document.addEventListener('DOMContentLoaded', function () {
    const inputImage = document.getElementById("file");
    const displayImage = document.querySelector(".img-preview");
    displayImage.src ="../img/jacquotles.gif";



    inputImage.addEventListener('change',function (){
        const [imagefile] = inputImage.files;
        console.log(inputImage.files);
        if(imagefile){
            displayImage.src = URL.createObjectURL(imagefile);
        }
        else {
            displayImage.src ="../img/jacquotles.gif";
        }

    });

});
const submit = document.getElementById("submit");
function validation(event){
    var error_msg = document.getElementById("error-msg");
    var nom = document.getElementById("nom");

    if(!compare() || !CheckNom(nom)){
        event.preventDefault();
    }

}
function compare(){

    var psw = document.getElementById("psw");
    var pswbis = document.getElementById("pswbis");
    var error_msg = document.getElementById("error-msg");
    if(psw.value != pswbis.value){
        error_msg.innerHTML = "Le mot de passe n'est pas le même, loser";
        return false;
    }
    else {
        error_msg.innerHTML = "";
        return true ;
    }

}
function CheckNom(self){
    var error_msg = document.getElementById("error-msg");
    var xmlhttp = new XMLHttpRequest();
    isgood =true;
    xmlhttp.onreadystatechange = function (){
        if (this.readyState == 4 && this.status == 200) {
            error_msg.innerHTML = this.responseText;

        }

    };
    xmlhttp.open("GET","../checkNom.php?Name="+self.value,true);
    xmlhttp.send();
    return isgood;

}

