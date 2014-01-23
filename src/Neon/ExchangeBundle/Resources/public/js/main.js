$(function() {
    $('.votes span').click(function(e) {
        e.preventDefault();
        var url, element = $(this);

        if ($(this).data('type') == 'question') {
            url = '/app_dev.php/question/vote/';
        } else if ($(this).data('type') == 'answer') {
            url = '/app_dev.php/answer/vote/';
        }

        $.ajax({
            url: url + $(this).data('id') + '/' + $(this).data('vote'),
            success: function (data, status) {
                if (isNaN(data)) {
                    alert(data);
                } else {
                    $(element).siblings('span.num').html(data);
                }
            }
        });
    });
});