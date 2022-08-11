export default function () {

    const $deleteQuestionButton = $('.delete-question');

    $deleteQuestionButton.click(function () {
        const confirmed = confirm("Are you sure you want to delete this post?");
        if (confirmed) {
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    'action': 'delete_question',
                    'question_id': $(this).data('question-id'),
                },
                success: function (data) {
                    const response = JSON.parse(data);
                    if (response.status) {
                        location.reload()
                    } else {
                        alert('Something was wrong during the form submission. Refresh and try again.')
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });

    const $deleteAnswerButton = $('.delete-answer');

    $deleteAnswerButton.click(function () {
        const confirmed = confirm("Are you sure you want to delete this answer?");
        if (confirmed) {
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: {
                    'action': 'delete_answer',
                    'answer_id': $(this).data('answer-id'),
                },
                success: function (data) {
                    const response = JSON.parse(data);
                    if (response.status) {
                        location.reload()
                    } else {
                        alert('Something was wrong during the form submission. Refresh and try again.')
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
}
