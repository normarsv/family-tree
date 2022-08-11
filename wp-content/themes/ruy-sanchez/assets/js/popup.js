export default function () {
    const $popup = $('.gt-popup');

    if ($popup.length) {
        const consent = localStorage.getItem('popup-consent');

        if (consent == null || new Date().getTime() > consent) {
            $popup.removeClass('hidden')
        }

        $('.close-popup').click(function () {
            const date = new Date()
            date.setDate(date.getDate() + 1); // 24hrs
            localStorage.setItem('popup-consent', date.getTime());
            $('.gt-popup').addClass('hidden');
        })
    }
}
