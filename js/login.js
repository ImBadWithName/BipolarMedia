

document.addEventListener('DOMContentLoaded', function nonScroll(){
    scrollHaut = window.pageYOffset;
    scrollGauche = window.pageXOffset;
    window.onscroll = function()
    {
        window.scrollTo(scrollGauche, scrollHaut);
    };
});