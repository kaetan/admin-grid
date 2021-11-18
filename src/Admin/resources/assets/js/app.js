$(document).ready(function () {

    $.fn.extend({
        animateCss: function (animationName, callback) {
            var animationEnd = (function (el) {
                var animations = {
                    animation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    MozAnimation: 'mozAnimationEnd',
                    WebkitAnimation: 'webkitAnimationEnd',
                };

                for (var t in animations) {
                    if (el.style[t] !== undefined) {
                        return animations[t];
                    }
                }
            })(document.createElement('div'));

            this.addClass('animated ' + animationName).one(animationEnd, function () {
                $(this).removeClass('animated ' + animationName);

                if (typeof callback === 'function') callback();
            });

            return this;
        },
    });


    // $( ".view-tab").click(function(event) {
    //     $('.nav-tabs a[href=#tab-chat]').tab('show'); //Открываем таб extra
    //     document.location.href = $(this).attr('href');  //меняем хэш урла
    //     return false;
    // });

    var anchor = window.location.hash.split('#');
    if(anchor[1] != ''){
        let text = '#' + anchor[1];
        $('a[href=\'' + text + '\']').click();
    }

    initElements($('body'));

    // Change page size
    $('.js-pagination-size').change(function () {
        document.location = $(this).val();
    });
    $(".js-range-slider").ionRangeSlider();

    $('.summernote').summernote(
        {
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'link']],
                ['view', ['codeview', 'help']],
            ],
        }
    );


});

// Custom checkboxes
function initCustomCheckboxes($container) {
    var $localContainer = null;
    if ($container) {
        $localContainer = $container;
    } else {
        $localContainer = $(document);
    }
    $localContainer.find('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
}

// Datepicker
function initDatepickers($container) {
    var $localContainer = null;
    if($container) {
        $localContainer = $container;
    } else {
        $localContainer = $(document);
    }
    $localContainer.find('.js-datepicker').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
}

function initClockpickers($container) {
    var $localContainer = null;

    if($container) {
        $localContainer = $container;
    } else {
        $localContainer = $(document);
    }

    $localContainer.find('.js-clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': '00:00'
    });
}


// Chosen
function initCustomSelects($html) {

    var $html = (typeof($html) != 'undefined') ? $html : $('body');

    $html.find('.js-chosen').each(function () {
        var $chosen = $(this);
        $chosen.next('.chosen-container').remove();
        $chosen.addClass('hidden').removeClass("chzn-done");
        setTimeout(function () {
            var maxSelected = $chosen.data('max-select-options');
            $chosen.removeData('chosen').chosen({
                width: "100%",
                max_selected_options: maxSelected ? maxSelected : 'infinity'
            });
        }, 0);
    });
}

function initElements($container) {
    initCustomCheckboxes($container);
    initDatepickers($container);
    initCustomSelects($container);
    initClockpickers($container);
    initShowForOption($container);
}

//Делает разделители между тысячными
function format_money(value)
{
    value += '';
    x = value.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ' ' + '$2');
    }
    return x1 + x2;
}
