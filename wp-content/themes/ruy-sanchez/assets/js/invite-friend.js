import {isEmailValid} from './shared/helpers'

export default function () {
    const $container = $('#invite-friend-modal'),
        $openModal = $('#invite-friend-modal-trigger'),
        $closeModal = $container.find('#gt-close-modal'),
        $submitBtn = $container.find('#invite-friend-submit'),
        $emailsInput = $container.find('[name="email"]'),
        $body = $container.find('[name="body"]'),
        $errorMsg = $container.find('.form-error')
    ;

    let validEmails = [];

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
        const emails = $emailsInput.val().split(',');
        emails.forEach((email) => {
            if (isEmailValid(email)) {
                validEmails.push(email)
            }
        })

        if (!validEmails.length) {
            $errorMsg.text('Error! Be sure the format of the emails is correct.').removeClass('hidden');
            return
        }

        if ($body.val() === '') {
            $errorMsg.text('Be sure to add a copy for the invitation').removeClass('hidden');
            return
        }

        $submitBtn.attr('disabled', 'disabled')
        $errorMsg.addClass('hidden')

        $.ajax({
            url: $submitBtn.data('url'),
            type: 'POST',
            data: {
                'action': 'invite_friend',
                'emails': JSON.stringify(validEmails),
                'body': $body.val()
            },
            success: function (data) {
                const response = JSON.parse(data);
                if (response.status) {
                    alert('Invites Sent.')
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