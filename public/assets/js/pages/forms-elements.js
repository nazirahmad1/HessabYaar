/**
 * Theme: Konrix - Responsive Tailwind Admin Dashboard
 * Author: Coderthemes
 */

flatpickr('#example-date', {
    enableTime: false,
    dateFormat: "Y-m-d",
    defaultDate: new Date(),
    locale: "fa",
});

flatpickr('#example-month', {
    enableTime: false,
    dateFormat: "M",
    defaultDate: new Date(),
    locale: "fa",
});

flatpickr('#example-time', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});

flatpickr('#example-date-time', {
    enableTime: true,
    dateFormat: "H:i Y-m-d",
    time_24hr: true,
    locale: "fa",
});