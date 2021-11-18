$(document).ready(function() {

    var $massUpdateSelectAction = $('.js-mass-update');
    if($massUpdateSelectAction.length) {
        $massUpdateSelectAction.on('click', function () {

            var $massUpdateContainer = $(this).closest('.js-grid-container');
            var $inputs = $massUpdateContainer.find('.js-check-item');

            var ids = [];
            // Пройдемся по чекбоксам в списке и составим список id для массового редактирования
            $inputs.each(function () {
                var $this = $(this);
                if (this.checked) {
                    ids.push($this.data('id'));
                }
            });
            var $massUpdateForm = $('.js-mass-update-form');

            $massUpdateForm.find('.js-mass-update-input').remove();

            var $massUpdateBtn = $massUpdateForm.find('.js-mass-update-btn');
            if (ids.length <= 0) {
                $massUpdateBtn.prop("disabled", true);
            } else {
                $massUpdateBtn.prop("disabled", false);
            }

            for (var i = 0; i < ids.length; i++) {
                var input = document.createElement('input');
                input.setAttribute('name', 'ids[]');
                input.setAttribute('value', ids[i]);
                input.setAttribute('type', 'hidden');
                input.setAttribute('class', 'js-mass-update-input');
                $massUpdateForm.prepend(input);
            }
        });
    }

});