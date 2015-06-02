
<!-- http://bootsnipp.com/snippets/featured/admin-nav-bar-with-popup-sign-in -->
$(document).ready(function(){
    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
});
