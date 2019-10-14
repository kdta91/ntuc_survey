$(function() {
    $(document).on('change', 'input[type="radio"], input[type="checkbox"]', function () {
        othersButtonChecked($(this));
    });

    $('input.custom').each(function() {
        if ($(this).is(':checked')) {
            othersButtonChecked($(this));
        }
    });

    function othersButtonChecked(el) {
        let propName = el.prop('name').replace('[]', '');
        if (el.hasClass('custom') && el.is(':checked')) {
            $('.others-container.' + propName).show();
        } else {
            $('.others-container.' + propName).hide();
        }
    }
});