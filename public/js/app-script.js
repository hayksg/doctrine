$(function(){
    if ($(document).width() > 767) {
        $('.navbar-brand').remove();
    } else {
        $('.nav.navbar-nav li:first-child').remove();
    }
});