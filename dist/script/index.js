"use strict";
document.addEventListener('DOMContentLoaded', function () {
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
            url: './myfeed.php',
            method: 'POST',
            failure: function () {
                console.error('there was an error while fetching events!');
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
        dateClick: function (info) {
            location.href = './template.html?date=' + info.dateStr; // schedule_formが出来次第変更
        },
        eventClick: function (info) {
            console.log('Event: ' + info.event.title);
        }
    });
    calendar.render();
});
