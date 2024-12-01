function showAddCom (id_post){
    let button_add_com = document.getElementById(id_post);
    let form_com = button_add_com.parentElement.parentElement.lastElementChild;
    let submit_com = form_com.lastElementChild;

    if (form_com.classList.contains("hidden") == true){
        form_com.classList.remove("hidden");
    }
    else {
        form_com.classList.add("hidden");
    }
    submit_com.addEventListener('click', function (){
        form_com.classList.add("hidden");
    })
    
};