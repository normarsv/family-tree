export default function () {

    const $container = $('#my-activity-panel'),
        $panelOpenerButton = $container.find('.panel-button')
    ;

    $panelOpenerButton.click(function () {
        $panelOpenerButton.removeClass('text-accent')

        const groupId = $(this).data('tab-id');
        $(this).addClass('text-accent');

        $container.find('.panel-group').addClass('hidden');
        $container.find(`#${groupId}`).removeClass('hidden');
    })
}