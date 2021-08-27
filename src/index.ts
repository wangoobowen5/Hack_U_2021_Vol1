document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    const buttonCancel = document.getElementById('button-cancel');
    const buttonClose = document.getElementById('button-close');
    const buttonSave = document.getElementById('button-save');
    let eventInfo;

    firebase.auth().onAuthStateChanged(function (user) {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
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
            dateClick: function(info) {
                location.href = './schedule_form.php?date=' + info.dateStr;  // schedule_formが出来次第変更
            },
            // 予定を押した時の処理
            eventClick: function(info) {
                eventInfo = info;
                modal?.style.display = 'block';
                let planData = {
                    'planid': info.event.extendedProps.planid,
                    'start': info.event.start,
                    'end': info.event.end
                };
                $.ajax({
                    type: 'POST',
                    url: 'get_plan_detail.php',
                    data: planData,
                    dataType: 'json'
                })
                .then(
                    data => {  // Ajax成功時の処理
                        console.log('succes: ' + data['planid'] + data['start']);
                    },
                    error => {  // Ajax失敗時の処理
                        console.log('error');
                    }
                )
            }
        });
        calendar.render();
    })

    // クローズボタン（×）を押したらモーダルを閉じる
    buttonClose?.addEventListener('click', () => {
        modal?.style.display = 'none';
    }, false);
    // キャンセルボタンを押したらモーダルを閉じる
    buttonCancel?.addEventListener('click', () => {
        modal?.style.display = 'none';
    }, false);
    // モーダル以外を押したらモーダルを閉じる
    window.addEventListener('click', e => {
        if (e.target == modalContent){
            modal?.style.display = 'none';
        }
    }, false);

    // 保存ボタンを押したらajaxでPOSTしてモーダルを閉じる
    buttonSave?.addEventListener('click', () => {
        let progressData = {
            "planid": eventInfo.event.extendedProps.planid,
            "progress": "'内容箇条書き':20,'スライド作成': 50,'発表練習':0"
        };
        $.ajax({
            type: 'POST',
            url: 'save_progress.php',
            data: progressData,
            dataType: 'json'
        })
        .then(
            data => {  // Ajax成功時の処理
                console.log('succes: ' + data['planid'] + " " + data['progress']);
            },
            error => {  // Ajax失敗時の処理
                console.log('error');
            }
        )

        modal?.style.display = 'none';
    }, false);
});