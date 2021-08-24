"use strict";
document.addEventListener('DOMContentLoaded', function () {
    $('#begin-input').timepicker({
        'timeFormat': 'H:i'
    });
    $('#end-input').timepicker({
        'timeFormat': 'H:i'
    });
}, false);
