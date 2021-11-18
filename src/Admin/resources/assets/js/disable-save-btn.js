$(document).ready(function () {
    $(".js-save-btn").each(function () {
        $(this).on("click", function () {
            $(".js-save-btn").each(function () {
                let button = $(this);
                setTimeout(function () {
                    button.prop("disabled", true);
                }, 10);
            });
        });
    });
});
