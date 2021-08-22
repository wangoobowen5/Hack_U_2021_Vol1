document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay, listWeek'
      }, 
      timeZone: 'Asia/Tokyo',
      locale: 'ja',
      eventTimeFormat: { hour: 'numeric', minute: '2-digit' },
      editable: true,
      events: [
        {
          title: 'Business Lunch',
          start: '2021-08-03T13:00:00',
          constraint: 'businessHours'
        },
        {
          title: 'Meeting',
          start: '2021-08-13T11:00:00',
          constraint: 'availableForMeeting', // defined below
          color: '#257e4a'
        }
    ],
    dateClick: function(info) {
        console.log('clicked on' + info.dateStr);
        location.href = './template.html?date=' + info.dateStr;
    },
    eventClick: function(info) {
        console.log('Event: ' + info.event.title);
    }
    });
    calendar.render();
});