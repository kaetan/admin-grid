$(document).ready(function () {

    checkboxEvents($(document));

    var $selectAll = $("#js-select-all");

    if ($selectAll.length) {
        $selectAll.on('ifChanged', function () {
            // Get parent form
            var $container = $(this).closest('.js-select-all-container');

            var $checkboxes = $container.find(':checkbox');

            $checkboxes.each(function () {
                if ($selectAll.prop('checked')) {
                    $(this).iCheck('check');
                } else {
                    $(this).iCheck('uncheck');

                }
            });
        });
    }
});

function checkboxEvents($container) {
    $container.find('.js-has-hidden').each(function () {
        $(this).prop('startValue', this.checked);
    });
    // Передача "1" и "0" вместо "on" для чекбокосв
    $('.js-has-hidden').change(function () {

        updateCheckboxHidden($(this), this.checked);
    }).on('ifChanged', function (event) {
        updateCheckboxHidden($(this), event.target.checked);
    }).on('reset', function (event) {
        updateCheckboxHidden($(this, this.startValue));

        if ($(this).prop('startValue')) {
            $(this).closest('.icheckbox_square-green').addClass('checked');
        } else {
            $(this).closest('.icheckbox_square-green').removeClass('checked');
        }
    });
}

function updateCheckboxHidden($checkbox, value) {
    var $hidden = $checkbox.closest('.js-checkbox-group').find('.js-checkbox-hidden');
    if ($hidden.length) {
        $hidden.val(value ? '1' : '0');
    }
}


function setCheckedStatusClass($checkbox, check) {
    if (check) {
        $checkbox.closest('.js-checkbox-group').find('.icheckbox_square-green').addClass('checked');
    } else {
        $checkbox.closest('.js-checkbox-group').find('.icheckbox_square-green').removeClass('checked');
    }
}
