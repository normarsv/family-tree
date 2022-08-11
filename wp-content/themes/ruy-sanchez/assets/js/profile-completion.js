export default function () {
    const $container = $('#profile-completion'),
        $submitBtn = $container.find('#confirm_button'),
        $thisThatPicker = $container.find('.this-that-picker'),
        $iconPicker = $container.find('.icon-picker'),
        $meetPicker = $container.find('.meet-picker')
    ;

    let thisThatOptions = {place: '', taste: '', animal: '', genre: ''};
    let iconOption = '';
    let howDidYouHear = '';

    $thisThatPicker.click(function () {
        const $this = $(this);
        let $parents = $container.find(`[data-type="${$this.data('type')}"]`);
        $parents.removeClass('radio-button-active')
        $this.addClass('radio-button-active');
        thisThatOptions[$this.data('type')] = $this.data('value')
    });

    $iconPicker.click(function () {
        $iconPicker.removeClass('bg-accent');
        const $this = $(this);
        iconOption = $this.data('value');
        $this.addClass('bg-accent')
    })

    $meetPicker.click(function () {
        $meetPicker.removeClass('radio-button-active');
        const $this = $(this);
        howDidYouHear = $this.data('value');
        $this.addClass('radio-button-active')
    })

    $submitBtn.click(function () {
        if (hasObjEmptyChilds(thisThatOptions)) {
            alert('You have to choose your "this or that" preferences')
            return
        }
        if (iconOption === '') {
            alert('You have to pick an icon')
            return
        }
        if (howDidYouHear === '') {
            alert('You have choose an option for the "how did you hear about us"')
            return
        }

        if (!$container.find('#advice_check').prop('checked')
            || !$container.find('#agreement_check').prop('checked')) {
            alert('You must consent the agreements.')
            return
        }

        $.ajax({
            url: $submitBtn.data('url'),
            type: 'POST',
            data: {
                'action': 'profile_completion',
                'thisthat': thisThatOptions,
                'icon': iconOption,
                'howdidyouhear': howDidYouHear,
            },
            success: function (data) {
                document.location.href = '/my-account'
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });

    });
}

function hasObjEmptyChilds(obj) {
    for (let prop in obj) {
        if (obj[prop] === '')
            return true;
    }
    return false;
}