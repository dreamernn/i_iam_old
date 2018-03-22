$(function () {
    $('.deleteFile').click(function (e) {
        console.log('clicked');
        var showId = $(this).data('show'), inputId = $(this).data('for');
        var showElement = $("#" + showId);
        showElement.hide();

        var key = showElement.attr('src') || showElement.attr('href');
        var inputElement = $("#" + inputId);
        inputElement.attr('type', 'hidden');
        inputElement.val(key);
    });
});