document.addEventListener('DOMContentLoaded', function() {
    firebase.auth().onAuthStateChanged(function (user) {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay, listWeek'
            },
            locale: 'ja',
            eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
            editable: true,
            // events: './get_plan.php',
            events: {
                url: './get_plan.php',
                extraParams: {
                    userid: user.uid
                }
            },
            // events: [  // バックエンドが出来次第削除
            // {
            //     id: '1111',
            //     title: '何でも相談会',
            //     start: '2021-08-19T13:00:00',
            //     end: '2021-08-19T17:00:00',
            //     color: '#EDAD0B'
            // },
            // {
            //     title: 'ミーティング',
            //     start: '2021-08-24T10:00:00',
            //     end: '2021-08-24T11:00:00',
            //     color: '#257e4a'
            // },
            // {
            //     title: 'HackU',
            //     start: '2021-08-28',
            //     end: '2021-08-28',
            //     color: '#99CFE5'
            // }
        // ],
            dateClick: function(info) {
                location.href = './schedule_form.php?date=' + info.dateStr;  // schedule_formが出来次第変更
            },
            eventClick: function(info) {
                console.log('Event: ' + info.event.title);
            }
        });
        calendar.render();
    })
    
    // モーダル表示用コード
    $(".info").modaal({
        overlay_close:true,//モーダル背景クリック時に閉じるか
        width: 800,
        height: 800,
        before_open:function(){// モーダルが開く前に行う動作
            $('html').css('overflow-y','hidden');/*縦スクロールバーを出さない*/
        },
        after_close:function(){// モーダルが閉じた後に行う動作
            $('html').css('overflow-y','scroll');/*縦スクロールバーを出す*/
        }
    });
});