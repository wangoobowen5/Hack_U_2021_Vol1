import { post } from './modules.js'

document.addEventListener('DOMContentLoaded', () => {
    flatpickr("#start-date", {locale:"ja"});
    flatpickr("#end-date", {locale:"ja"});

    document.getElementById('form-register-button').addEventListener('click', () => {
        const scheduleName: string = document.getElementById('schedule-name').value;
        const templateList: any = document.getElementById("template-list");
        const num: number = templateList.selectedIndex;
        const templateId: string = templateList.options[num].value;
        const startDate: string = document.getElementById('start-date').value;
        const endDate: string = document.getElementById('end-date').value;
        firebase.auth().onAuthStateChanged(function (user) {
            const data: any = {
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