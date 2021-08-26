"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modal');
    var modalContent = document.getElementById('modal-content');
    var buttonCancel = document.getElementById('button-cancel');
    var buttonClose = document.getElementById('button-close');
    firebase.auth().onAuthStateChanged(function (user) {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            locale: 'ja',
            eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
            editable: true,
            // カレンダーに予定一覧を表示する処理
            events: {
                url: './get_plan.php',
                extraParams: {
                    userid: user.uid
                }
            },
            // 日付を押した時の処理
            dateClick: function (info) {
                location.href = './schedule_form.php?date=' + info.dateStr; // schedule_formが出来次第変更
            },
            // 予定を押した時の処理
            eventClick: function (info) {
                console.log('Event: ' + info.event.title);
                modal === null || modal === void 0 ? void 0 : modal.style.display = 'block';
            }
        });
        calendar.render();
    });
    // キャンセルボタンを押したらモーダルを閉じる
    buttonClose === null || buttonClose === void 0 ? void 0 : buttonClose.addEventListener('click', function () {
        modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
    }, false);
    // キャンセルボタンを押したらモーダルを閉じる
    buttonCancel === null || buttonCancel === void 0 ? void 0 : buttonCancel.addEventListener('click', function () {
        modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
    }, false);
    // モーダル以外を押したらモーダルを閉じる
    window.addEventListener('click', function (e) {
        if (e.target == modalContent) {
            modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
        }
    }, false);
});
