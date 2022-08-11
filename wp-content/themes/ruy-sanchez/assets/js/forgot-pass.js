import {isPasswordFormatValid} from './shared/helpers'

export default function () {
    const $form = $('#reset-pass-form'),
        $password = $form.find('#pass'),
        $confirm_pass = $form.find('#pass_confirm'),
        $submit_btn = $form.find('#reset_submit')
    ;

    $submit_btn.click(function (e) {
        e.preventDefault()

        if ($password.val() !== $confirm_pass.val()) {
            $confirm_pass.find('+ .input-error').removeClass('hidden').text('Password confirmation is not the same')
            return
        }

        if (!isPasswordFormatValid($password.val())) {
            alert('invalid password')
            $password.find('+ .input-error').removeClass('hidden').text('Required minimum 8 characters, at least one letter, one number and one special char')
            return
        }

        $submit_btn.attr('disabled', 'disabled')
        $form.submit();
    })
}