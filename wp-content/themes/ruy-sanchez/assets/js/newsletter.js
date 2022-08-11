export default function () {
    $('#newsletter-form').submit(function (e) {
        e.preventDefault()
        const $form = $(this),
            $email = $form.find('#email_newsletter'),
            $successMsg = $form.find('#newsletter_success_msg')

        if ($email.val() !== '') {
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: {
                    'action': 'newsletter_submit',
                    'email': $email.val(),
                },
                success: function (data) {
                    $successMsg.removeClass('hidden')
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    })
}