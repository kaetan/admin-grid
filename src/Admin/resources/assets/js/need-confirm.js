$(document).ready(function() {
    var $needConfirm = $('.js-need-confirm');
    if($needConfirm.length) {
        $needConfirm.on('click', function (e) {
            var defaultConfirmMessage = 'Вы уверены?';
            var confirmMessage = $(e.target).attr('confirmMessage');
            return confirm(confirmMessage ? confirmMessage : defaultConfirmMessage);
        })
    }
});