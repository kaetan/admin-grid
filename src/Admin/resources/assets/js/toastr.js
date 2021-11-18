$(document).ready(function() {
    if ($('.js-toastr-message').length) {
        var type = $('.js-toastr-message').data('toastr');
        var message = $('.js-toastr-message').text();

        toastr.options = {
            closeButton: false,
            debug: false,
            progressBar: false,
            preventDuplicates: false,
            positionClass: "toast-top-right",
            onclick: null,
            showDuration: "400",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        toastr[type](" ", '<div style="margin-top: 5px;">'+message+'</div>')
    }
});