console.log('l affichage ce lance');
document.addEventListener('DOMContentLoaded', function () {

    const inputImage = document.getElementById("file");
    const displayImage = document.querySelector(".img-preview");
    inputImage.addEventListener('change',function (){
        const [imagefile] = inputImage.files
        if(imagefile){
            displayImage.src = URL.createObjectURL(imagefile);
        }
    });
});