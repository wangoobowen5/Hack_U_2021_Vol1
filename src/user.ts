import { post } from './modules.js'

document.addEventListener('DOMContentLoaded', () => {
    $('#begin-time').timepicker({
        'timeFormat': 'H:i'
    });
    $('#end-time').timepicker({
        'timeFormat': 'H:i'
    });

    document.getElementById('schedule-update-button').addEventListener('click', () => {
        let beginTime: string = document.getElementById('begin-time').value;
        let endTime: string = document.getElementById('end-time').value;
        firebase.auth().onAuthStateChanged(function (user) {
            const data: any = {
                "userid": user.uid,
                "begin-time": beginTime,
                "end-time": endTime
            };
            post('/Hack_U_2021_Vol1/dist/user.php', data);
        });
    }, false);
}, false);