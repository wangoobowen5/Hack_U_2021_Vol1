"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var beginTime = $('#begin-time').attr('value');
    var endTime = $('#end-time').attr('value');
    $('#begin-time').timepicker({
        'timeFormat': 'H:i'
    });
    $('#end-time').timepicker({
        'timeFormat': 'H:i'
    });
}, false);
