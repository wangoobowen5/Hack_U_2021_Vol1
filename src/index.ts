document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    const buttonCancel = document.getElementById('button-cancel');
    const buttonClose = document.getElementById('button-close');
    const buttonSave = document.getElementById('button-save');
    const modalTitle = document.getElementById('modal-title');
    const modalTime = document.getElementById('modal-time');
    const modalGoal = document.getElementById('modal-goal');
    const modalProgress = document.getElementById('modal-progress');
    let eventInfo;

    const DoW = {
        'Mon': '月',
        'Tue': '火',
        'Wed': '水',
        'Thu': '木',
        'Fri': '金',
        'Sat': '土',
        'Sun': '日'
    };

    const Month = {
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
                    'date': info.event.start.toString()
                };
                $.ajax({
                    type: 'POST',
                    url: 'get_plan_detail.php',
                    data: planData,
                    dataType: 'json'
                })
                .then(
                    data => {  // Ajax成功時の処理
                        console.log('succes');
                        const goal = devideSentence(data['goal']);
                        const progress = devideSentence(data['progress']);
                        const task = devideSentence(data['task']);
                        createModalElements(info, goal, progress, task);
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

    function createModalElements(info, goal, progress, task) {
        // 初期化
        initModal();
        modalTitle?.textContent = info.event.title;
        modalTime?.textContent = arrangeTime(info.event.start, info.event.end);
        // 今日の目標
        for (let i of goal) {
            const modalGoalChild = document.createElement('div');
            modalGoalChild.className = 'flex-row';
            const modalGoalText = document.createElement('p');
            const modalGoalRatio = document.createElement('p');
            modalGoalText.textContent = i[0];
            modalGoalRatio.textContent = i[1] + '%';
            modalGoalChild.appendChild(modalGoalText);
            modalGoalChild.appendChild(modalGoalRatio);
            modalGoal?.appendChild(modalGoalChild);
        }
        // 進捗
        for (let i=0; i<progress.length; i++) {
            const modalProgressChild = document.createElement('div');
            modalProgressChild.classList.add('flex-row', 'progress');
            const modalProgressText = document.createElement('p');
            modalProgressText.textContent = progress[i][0]
            const modalProgressDiv = document.createElement('div');
            modalProgressDiv.className = 'flex-row';
            const modalProgressInputRapper = document.createElement('p');
            const modalProgressInput = document.createElement('input');
            const modalProgressTaskRatio = document.createElement('p');
            modalProgressInput.type = "text";
            modalProgressInput.className = "progress-input";
            modalProgressInput.value = progress[i][1];
            modalProgressTaskRatio.textContent = " / " + task[i][1] + "%";
            modalProgressInputRapper.appendChild(modalProgressInput);
            modalProgressDiv.appendChild(modalProgressInputRapper);
            modalProgressDiv.appendChild(modalProgressTaskRatio);
            modalProgressChild.appendChild(modalProgressText);
            modalProgressChild.appendChild(modalProgressDiv);
            modalProgress?.appendChild(modalProgressChild);
        }
    }

    function devideSentence(s: string) {
        const devideComma = s.split(',');
        const devidedSentence = [];
        for (let i of devideComma) {
            devidedSentence.push(i.split(':'));
        }
        return devidedSentence;
    }

    function initModal() {
        removeChilds(modalGoal);
        removeChilds(modalProgress);
    }

    function removeChilds(parent) {
        while(parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    function arrangeTime(start, end) {
        start = start.toString().split(' ');
        end = end.toString().split(' ');
        let time = Month[start[1]] + '/' + start[2] + '(' + DoW[start[0]] + ') ';
        if (end) {
            time = time + start[4].slice(0, -3) + '〜' + end[4].slice(0, -3);
        }
        return time;
    }
});