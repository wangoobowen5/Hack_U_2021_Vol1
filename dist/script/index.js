"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modal');
    var modalContent = document.getElementById('modal-content');
    var buttonCancel = document.getElementById('button-cancel');
    var buttonClose = document.getElementById('button-close');
    var buttonSave = document.getElementById('button-save');
    var modalTitle = document.getElementById('modal-title');
    var modalTime = document.getElementById('modal-time');
    var modalGoal = document.getElementById('modal-goal');
    var modalProgress = document.getElementById('modal-progress');
    var eventInfo;
    var DoW = {
        'Mon': '月',
        'Tue': '火',
        'Wed': '水',
        'Thu': '木',
        'Fri': '金',
        'Sat': '土',
        'Sun': '日'
    };
    var Month = {
        'Jan': '1',
        'Feb': '2',
        'Mar': '3',
        'Apr': '4',
        'May': '5',
        'Jun': '6',
        'Jul': '7',
        'Aug': '8',
        'Sep': '9',
        'Oct': '10',
        'Nov': '11',
        'Dec': '12'
    };
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
                    createModalElements(info, goal, progress, task);
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
    function createModalElements(info, goal, progress, task) {
        initModal();
        modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.textContent = info.event.title;
        modalTime === null || modalTime === void 0 ? void 0 : modalTime.textContent = arrangeTime(info.event.start, info.event.end);
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
    function initModal() {
        removeChilds(modalGoal);
        removeChilds(modalProgress);
    }
    function removeChilds(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
    function arrangeTime(start, end) {
        start = start.toString().split(' ');
        end = end.toString().split(' ');
        console.log(start);
        var time = Month[start[1]] + '/' + start[2] + '(' + DoW[start[0]] + ') ';
        if (end) {
            time = time + start[4].slice(0, -3) + '〜' + end[4].slice(0, -3);
        }
        return time;
    }
});
