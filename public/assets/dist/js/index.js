$(document).scroll(() => {
    var classed = $('.navbar');
    classed.toggleClass('shadow bg-white', $(this).scrollTop() > classed.height());
});


$(document).ready(function(){
    $(".dropdown").hover(function(){
        $(".dropdown-menu").slideToggle();
    });
});