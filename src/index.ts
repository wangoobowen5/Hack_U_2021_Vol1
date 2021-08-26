document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    const closeButton = document.getElementById('button-close');

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
            events: {
                url: './get_plan.php',
                extraParams: {
                    userid: user.uid
                }
            },
            dateClick: function(info) {
                location.href = './schedule_form.php?date=' + info.dateStr;  // schedule_formが出来次第変更
            },
            eventClick: function(info) {
                console.log('Event: ' + info.event.title);
                modal?.style.display = 'block';
            }
        });
        calendar.render();
    })

    closeButton?.addEventListener('click', () => {
        modal?.style.display = 'none';
    }, false);

    window.addEventListener('click', e => {
        console.log(e.target);
        console.log(modalContent)
        if (e.target == modalContent){
            modal?.style.display = 'none';
        }
    }, false);
});