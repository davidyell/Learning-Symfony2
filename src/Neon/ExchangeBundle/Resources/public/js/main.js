$(function() {

    $('.votes span.vote').click(function(e) {
        e.preventDefault();
        var url, element = $(this);

        if ($(this).data('type') === 'question') {
            url = '/app_dev.php/question/vote/';
        } else if ($(this).data('type') === 'answer') {
            url = '/app_dev.php/answer/vote/';
        }

        $.ajax({
            url: url + $(this).data('id') + '/' + $(this).data('vote'),
            success: function (data, status) {
                if (isNaN(data)) {
                    alert('Something went wrong!');
                } else {
                    $(element).siblings('span.num').html(data);
                }
            }
        });
    });

	$('.votes span.accept').click(function (e) {
		var element = $(this);
		e.preventDefault();
		$.ajax({
			url: '/app_dev.php/question/accept_answer/' + $(this).data('question-id') + '/' + $(this).data('answer-id'),
			success: function (data, status) {
				$(element).addClass('label-success');
				$(element).children('i').addClass('icon-white');
			}
		});
	});

});