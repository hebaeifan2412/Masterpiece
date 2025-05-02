
document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar');
  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,dayGridWeek,dayGridDay'
    },
    events: [
     
      {
        title: 'Meeting',
        start: '2023-08-15',
        color: '#3f51b5'
      }
    ],
    themeSystem: 'bootstrap5'
  });
  calendar.render();
});
