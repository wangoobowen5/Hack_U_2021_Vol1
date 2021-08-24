import { post } from './modules.js';
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#start-date", { locale: "ja", minDate: "today" });
    flatpickr("#end-date", { locale: "ja", minDate: "today" });
    document.getElementById('form-register-button').addEventListener('click', function () {
        var scheduleName = document.getElementById('schedule-name').value;
        var templateList = document.getElementById("template-list");
        var num = templateList.selectedIndex;
        var templateName = templateList.options[num].value;
        var startDate = document.getElementById('start-date').value;
        var endDate = document.getElementById('end-date').value;
        firebase.auth().onAuthStateChanged(function (user) {
            var data = {
                "userid": user.uid,
                "scheduleName": scheduleName,
                "templateName": templateName,
                "start-date": startDate,
                "end-date": endDate
            };
            post('/Hack_U_2021_Vol1/dist/index.php', data);
        });
    }, false);
}, false);
