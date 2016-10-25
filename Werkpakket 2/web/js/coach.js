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

$(document).ready(function () {
    $('#reportCarousel .reportItem:first').addClass('active');
    $('.status').fadeIn(2000, function () {
        $('.status').fadeOut(1000);
    });

});