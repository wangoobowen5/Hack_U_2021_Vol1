import { post } from './modules.js'

document.addEventListener('DOMContentLoaded', () => {
    flatpickr("#start-flatpickr", {locale:"ja", minDate:"today"});
    flatpickr("#end-flatpickr", {locale:"ja", minDate:"today"});

    // document.getElementById('schedule-update-button').addEventListener('click', () => {
    //     let beginTime: string = document.getElementById('begin-time').value;
    //     let endTime: string = document.getElementById('end-time').value;
    //     firebase.auth().onAuthStateChanged(function (user) {
    //         const data: any = {
    //             "userid": user.uid,
    //             "begin-time": beginTime,
    //             "end-time": endTime
    //         };
    //         post('/Hack_U_2021_Vol1/dist/user.php', data);
    //     });
    // }, false);
}, false);