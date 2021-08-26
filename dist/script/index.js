"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modal');
    var modalContent = document.getElementById('modal-content');
    var closeButton = document.getElementById('button-close');
    firebase.auth().onAuthStateChanged(function (user) {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay, listWeek'
            },
            locale: 'ja',
            eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
            editable: true,
            events: {
                url: './get_plan.php',
                extraParams: {
                    userid: user.uid
                }
            },
            dateClick: function (info) {
                location.href = './schedule_form.php?date=' + info.dateStr; // schedule_formが出来次第変更
            },
            eventClick: function (info) {
                console.log('Event: ' + info.event.title);
                modal === null || modal === void 0 ? void 0 : modal.style.display = 'block';
            }
        });
        calendar.render();
    });
    closeButton === null || closeButton === void 0 ? void 0 : closeButton.addEventListener('click', function () {
        modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
    }, false);
    window.addEventListener('click', function (e) {
        console.log(e.target);
        console.log(modalContent);
        if (e.target == modalContent) {
            modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
        }
    }, false);
});
