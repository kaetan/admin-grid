$(document).ready(function() {
    $('.js-permission-enable').on('ifChanged', function () {

        var $checkbox = $(this),
            checked = $checkbox.is(':checked'),
            $wrap = $checkbox.closest('.js-permission-row'),
            $selects = $wrap.find('.js-disalable');

        if (checked) {
            $selects.removeAttr('disabled');
        } else {
            $selects.attr('disabled', 'disabled');
        }
    })
});