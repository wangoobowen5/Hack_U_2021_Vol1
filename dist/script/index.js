"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modal');
    var modalContent = document.getElementById('modal-content');
    var buttonCancel = document.getElementById('button-cancel');
    var buttonClose = document.getElementById('button-close');
    var buttonSave = document.getElementById('button-save');
    var eventInfo;
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
                eventInfo = info;
                modal === null || modal === void 0 ? void 0 : modal.style.display = 'block';
                var planData = {
                    'planid': info.event.extendedProps.planid
                };
                $.ajax({
                    type: 'POST',
                    url: 'get_plan_detail.php',
                    data: planData,
                    dataType: 'json'
                })
                    .then(function (data) {
                    console.log('succes: ' + data['goal'] + data['progress'] + data['task']);
                    var goal = devideSentence(data['goal']);
                    var progress = devideSentence(data['progress']);
                    var task = devideSentence(data['task']);
                    console.log(goal);
                    console.log(progress);
                    console.log(task);
                    // createModalElements(data['goal'])
                }, function (error) {
                    console.log('error');
                });
            }
        });
        calendar.render();
    });
    // クローズボタン（×）を押したらモーダルを閉じる
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
    // 保存ボタンを押したらajaxでPOSTしてモーダルを閉じる
    buttonSave === null || buttonSave === void 0 ? void 0 : buttonSave.addEventListener('click', function () {
        var progressData = {
            "planid": eventInfo.event.extendedProps.planid,
            "progress": "'内容箇条書き':20,'スライド作成': 50,'発表練習':0"
        };
        $.ajax({
            type: 'POST',
            url: 'save_progress.php',
            data: progressData,
            dataType: 'json'
        })
            .then(function (data) {
            console.log('succes: ' + data['planid'] + " " + data['progress']);
        }, function (error) {
            console.log('error');
        });
        modal === null || modal === void 0 ? void 0 : modal.style.display = 'none';
    }, false);
    function createModalElements(goal, progress, task) {
    }
    function devideSentence(s) {
        var devideComma = s.split(',');
        var devidedSentence = [];
        for (var _i = 0, devideComma_1 = devideComma; _i < devideComma_1.length; _i++) {
            var i = devideComma_1[_i];
            devidedSentence.push(i.split(':'));
        }
        return devidedSentence;
    }
});
