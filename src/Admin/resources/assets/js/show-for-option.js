$(document).ready(function () {
    var $showForContainer = $('.js-edit-form');

    initShowForOption($showForContainer);
});
function initShowForOption($showForContainer) {
    $showForContainer.each(function() {
        var $container = $(this);
        var $showableElements = $container.find('.js-show-for-option');

        $showableElements.each(function() {
            var $showable = $(this);
            var dependsOnSelector = $showable.data('depends-on');
            var $dependsOnElement = $container.find(dependsOnSelector);

            processShowable($showable, $dependsOnElement);

            $dependsOnElement.on('change', function() {
                processShowable($showable, $dependsOnElement);
            });

            function processShowable($showable, $dependsOnElement) {
                //Получаем значение атрибута для одиночных значений
                var dependsOnTargetValue = $showable.data('depends-on-value');
                //Получаем значение атрибута для множественных значений
                var dependsOnTargetValues = $showable.data('depends-on-values');
                //Получаем текущее значение отслеживаемого элемента
                var currentDependsOnValue = $dependsOnElement.val();

                var currentDependsValueEqualsNeed = false;
                // Если задано множественное значение атрибута, то ищем среди них
                if (dependsOnTargetValues != undefined) {
                    var valueIndex = dependsOnTargetValues.indexOf(currentDependsOnValue);
                    if (valueIndex != -1) {
                        currentDependsValueEqualsNeed = true;
                    }
                } else {
                    //Иначе ищем по одиночному атрибуту
                    if (currentDependsOnValue == dependsOnTargetValue) {
                        currentDependsValueEqualsNeed = true;
                    }
                }
                //Если текущее зависимое значение рано нужным, то показываем элемент
                if(currentDependsValueEqualsNeed) {
                    $showable.show();
                } else {
                    $showable.hide();
                }
            }
        });
    });
}