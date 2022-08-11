export default function () {
    const $container = $('#answer-modal'),
        $openModal = $('.open-answer-modal'),
        $closeModal = $container.find('#gt-close-modal'),
        $submitBtn = $container.find('#answer-submit'),
        $body = $container.find('[name="answer-body"]'),
        $postId = $container.find('[name="post_id"]'),
        $errorMsg = $container.find('.form-error')
    ;

    $openModal.click(() => {
        $container.show().addClass('ease-out duration-300 opacity-100')
    })

    $closeModal.click(() => {
        $container.removeClass('ease-out duration-300 opacity-100').addClass('opacity-0 ease-in duration-200')
        setTimeout(() => {
            $container.hide()
        }, 500);
    })

    $submitBtn.click(() => {
        if ($body.val() === '') {
            $errorMsg.text('You have to fill all the fields.').removeClass('hidden');
            return
        }

        $submitBtn.attr('disabled', 'disabled')

        $.ajax({
            url: $submitBtn.data('url'),
            type: 'POST',
            data: {
                'action': 'answer_question',
                'post_id': $postId.val(),
                'body': $body.val(),
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
    })
}