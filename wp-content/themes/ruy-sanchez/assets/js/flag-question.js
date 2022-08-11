export default function () {
    const $flagButton = $('.flag-question-trigger');

    $flagButton.click(function () {
        const confirmed = confirm('Are you sure you want to mark this post as flagged?')
        const $that = $(this)

        if (confirmed) {
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    'action': 'flag_question',
                    'question_id': $(this).data('question-id')
                },
                success: function (data) {
                    const response = JSON.parse(data);
                    if (response.status) {
                        alert('This post has been flagged.\nWe’ll take it from here.')
                        $that.hide()
                    } else {
                        alert('Something was wrong during the form submission. Refresh and try again.')
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    })
}