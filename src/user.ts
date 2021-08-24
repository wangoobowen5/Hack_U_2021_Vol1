document.addEventListener('DOMContentLoaded', () => {
    let beginTime: string = $('#begin-time').attr('value');
    let endTime: string = $('#end-time').attr('value');

    $('#begin-time').timepicker({
        'timeFormat': 'H:i'
    });
    $('#end-time').timepicker({
        'timeFormat': 'H:i'
    });
}, false);