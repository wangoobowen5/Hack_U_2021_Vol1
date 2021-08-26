import { post } from './modules.js';
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#start-date", { locale: "ja" });
    flatpickr("#end-date", { locale: "ja" });
    document.getElementById('form-register-button').addEventListener('click', function () {
        var scheduleName = document.getElementById('schedule-name').value;
        var templateList = document.getElementById("template-list");
        var num = templateList.selectedIndex;
        var templateId = templateList.options[num].value;
        var startDate = document.getElementById('start-date').value;
        var endDate = document.getElementById('end-date').value;
        firebase.auth().onAuthStateChanged(function (user) {
            var data = {
                "userid": user.uid,
                "title": scheduleName,
                "templateid": templateId,
                "start_date": startDate,
                "end_date": endDate
            };
            post('/Hack_U_2021_Vol1/dist/add_plan.php', data);
        });
    }, false);
}, false);
