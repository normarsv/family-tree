export default function () {
    const $container = $('#question-modal'),
        $openModal = $('.open-question-modal'),
        $closeModal = $container.find('#gt-close-modal'),
        $submitBtn = $container.find('#question-submit'),
        $title = $container.find('[name="question-title"]'),
        $body = $container.find('[name="question-body"]'),
        $topic = $container.find('[name="question-topic"]'),
        $tags = $container.find('[name="question-tags"]'),
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
        if ($title.val() === '' || $body.val() === '') {
            $errorMsg.text('You have to fill all the fields.').removeClass('hidden');
            return
        }

        $submitBtn.attr('disabled', 'disabled')

        $.ajax({
            url: $submitBtn.data('url'),
            type: 'POST',
            data: {
                'action': 'create_question',
                'title': $title.val(),
                'body': $body.val(),
                'tax': $topic.val(),
                'tags': $tags.val(),
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