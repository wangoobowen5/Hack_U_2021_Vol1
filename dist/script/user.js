import { post } from './modules.js';
document.addEventListener('DOMContentLoaded', function () {
    $('#begin-time').timepicker({
        'timeFormat': 'H:i'
    });
    $('#end-time').timepicker({
        'timeFormat': 'H:i'
    });
    document.getElementById('schedule-update-button').addEventListener('click', function () {
        var beginTime = document.getElementById('begin-time').value;
        var endTime = document.getElementById('end-time').value;
        firebase.auth().onAuthStateChanged(function (user) {
            var data = {
                "userid": user.uid,
                "begin-time": beginTime,
                "end-time": endTime
            };
            post('/Hack_U_2021_Vol1/dist/user.php', data);
        });
    }, false);
}, false);
