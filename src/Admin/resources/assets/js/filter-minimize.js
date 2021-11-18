$(document).ready(function () {
    // Minimize menu
    $(document).on('click', '.js-filter-minimize', function() {
        var $this = $(this);
        var $filterContainer = $this.closest('.js-filter-container');
        var value = $filterContainer.data('hidden');
        var cookieName = $filterContainer.data('cookie');
        var revertedValue = value ? 0 : 1;
        $filterContainer.data('hidden', revertedValue);
        $.cookie(cookieName, revertedValue);
    });
});