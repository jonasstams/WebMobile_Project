$(document).ready(function () {
    $("#last").click(function(){
        $('#reportCarousel .active').removeClass('active');
        $('#reportCarousel .reportItem:last-child').addClass('active');
    });

    $("#first").click(function(){
        $('#reportCarousel .active').removeClass('active');
        $('#reportCarousel .reportItem:first-child').addClass('active');
    });
});
