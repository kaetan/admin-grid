$(document).ready(function () {

    // проверка при ресайзе страницы
    $(document).on('click', '.js-dropdown-menu-container', function(event) {
        var $el = $(event.target);
        var $container = $el.parent('.js-dropdown-menu-container');
        actualizeDropdownDirection($container);
    });
});

// функция проверки полной видимости элемента
function actualizeDropdownDirection($el) {
    // проскроллено сверху
    var top_scroll = $(document).scrollTop();
    // высота видимой страницы
    var screen_height = $(window).height();

    // расстояние от нижнего края окна до верхнего края страницы
    var see_y2 = screen_height + top_scroll;


    // координаты дива
    var div_position = $el.offset();
    // отступ сверху
    var div_top = div_position.top;
    // высота
    var div_height = $el.height();
    //высота выплывающего меню
    var elem_height = $el.find(".js-dropdown-menu").height();
    // расстояние от элемента до нижнего края окна
    var bottom = see_y2 - div_top - div_height;

    if (elem_height >= bottom) {
        $el.addClass("dropup");
    } else {
        $el.removeClass("dropup");
    }
}