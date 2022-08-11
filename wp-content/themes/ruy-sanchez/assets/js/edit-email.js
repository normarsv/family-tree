import {isEmailValid} from './shared/helpers'

export default function () {
    const $container = $('#email-update-modal'),
        $openModal = $('.email-update-modal-trigger'),
        $closeModal = $container.find('#gt-close-modal'),
        $submitBtn = $container.find('#email-update-submit'),
        $email = $container.find('[name="email"]'),
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
        if (!isEmailValid($email.val())) {
            $errorMsg.text('You have to add a valid email.').removeClass('hidden');
            return
        }

        $submitBtn.attr('disabled', 'disabled')

        $.ajax({
            url: $submitBtn.data('url'),
            type: 'POST',
            data: {
                'action': 'update_email',
                'email': $email.val(),
            },
            success: function (data) {
                const response = JSON.parse(data);
                if (response.status) {
                    location.reload()
                } else {
                    if (response.email_exists !== undefined) {
                        $errorMsg.text('This email is already taken. Use a different one.').removeClass('hidden');
                        $submitBtn.removeAttr('disabled')
                    } else {
                        alert('Something was wrong during the form submission. Refresh and try again.')
                    }
                }
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    })
}