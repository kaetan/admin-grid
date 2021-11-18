$(document).ready(function () {
    // Minimize menu
    $(document).on('click', '.js-menu-minimize', function() {
        var value = $('body').hasClass('mini-navbar');
        $.cookie("menuMinimize", value ? 1 : 0);
    });
});