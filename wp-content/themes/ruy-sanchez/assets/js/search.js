export default function () {
    const $container = $('#search-modal'),
        $panelOpenerButton = $('.open-search'),
        $closeModal = $container.find('#gt-close-modal')
    ;

    $panelOpenerButton.click(function () {
        console.log($container)
        $container.show().addClass('ease-out duration-300 opacity-100')

    })

    $closeModal.click(() => {
        $container.removeClass('ease-out duration-300 opacity-100').addClass('opacity-0 ease-in duration-200')
        setTimeout(() => {
            $container.hide()
        }, 500);
    })
}