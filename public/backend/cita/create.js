let $doctor, $date, $specialty, $hours;
let iRadio;
const noHoursAlert = `<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico seleccionado.
</div>`;
$(function() {
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hours = $('#hours');
    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded(doctors) {
    //console.log(doctors);
    let htmlOptions = '';
    doctors.forEach(doctor => {
        //console.log(`${doctor.id} - ${doctor.name}`);
        htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
    });
    $doctor.html(htmlOptions);
    loadHours();
}

function loadHours() {
    //alert('hola');
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    //console.log(data);
    if (!data.morning && !data.afternoon) {
        $hours.html(noHoursAlert);
        return;
    }
    let htmlHours = '';
    iRadio = 0;
    if (data.morning) {
        const morning_intervals = data.morning;
        morning_intervals.forEach(interval => {
            //console.log(`${interval.start} - ${interval.end}`)
            //htmlHours += `${interval.start} - ${interval.end}`;
            htmlHours += getRadioHtml(interval);
        });
    }
    if (data.afternoon) {
        const afternoon_intervals = data.afternoon;
        afternoon_intervals.forEach(interval => {
            //console.log(`${interval.start} - ${interval.end}`)
            //htmlHours += `${interval.start} - ${interval.end}`;
            htmlHours += getRadioHtml(interval);
        });
    }
    $hours.html(htmlHours);
}

function getRadioHtml(interval) {
    const text = `${interval.start} - ${interval.end}`;
    return `<div class="custom-control custom-radio mb-3">
    <input type="radio" id="interval${iRadio}" value="${interval.start}" name="scheduled_time" class="custom-control-input">
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`
}