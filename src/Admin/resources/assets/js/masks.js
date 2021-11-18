$(document).ready(function () {
    phoneMasks();
});

function phoneMasks() {
    $("input[name=phone]").each(function () {
        let $input = $(this);

        if (!$input.hasClass("js-disable-mask")) {
            $input.inputmask({ mask: "79999999999" });
        }
    });
}
