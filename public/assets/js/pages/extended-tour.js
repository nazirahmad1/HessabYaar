/*
Template Name: Konrix - Responsive Tailwind Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Tour init js
*/

var tour = new Shepherd.Tour({
    defaultStepOptions: {
        cancelIcon: {
            enabled: true
        },

        classes: 'card',
        scrollTo: {
            behavior: 'smooth',
            block: 'center'
        }
    },
    useModalOverlay: {
        enabled: true
    },
});

if (document.querySelector('#logo-tour'))
    tour.addStep({
        title: 'لوگو در اینجا',
        text: `می‌توانید در اینجا وضعیت کاربری که در حال حاضر آنلاین است را ببینید.`,
        attachTo: {
            element: '#logo-tour',
            on: 'bottom'
        },
        buttons: [{
            text: 'بعدی',
            classes: 'btn mx-1 btn-success',
            action: tour.next
        }]
    });    

if (document.querySelector('#tour-card-one'))
    tour.addStep({
        title: 'کارت یک',
        text: `می‌توانید در اینجا وضعیت کاربری که در حال حاضر آنلاین است را ببینید.`,
        attachTo: {
            element: '#tour-card-one',
            on: 'bottom'
        },
        buttons: [{
                text: 'قبلی',
                classes: 'btn mx-1 btn-light',
                action: tour.back
            },
            {
                text: 'بعدی',
                classes: 'btn mx-1 btn-success',
                action: tour.next
            }
        ]
    });
    

if (document.querySelector('#tour-card-two'))
    tour.addStep({
        title: 'کارت دو',
        text: `می‌توانید در اینجا وضعیت کاربری که در حال حاضر آنلاین است را ببینید.`,
        attachTo: {
            element: '#tour-card-two',
            on: 'bottom'
        },
        buttons: [{
            text: 'قبلی',
            classes: 'btn mx-1 btn-light',
            action: tour.back
        },
        {
            text: 'بعدی',
            classes: 'btn mx-1 btn-success',
            action: tour.next
        }
        ]
    });


if (document.querySelector('#tour-card-three'))
    tour.addStep({
        title: 'کارت سه',
        text: `می‌توانید در اینجا وضعیت کاربری که در حال حاضر آنلاین است را ببینید.`,
        attachTo: {
            element: '#tour-card-three',
            on: 'bottom'
        },
        buttons: [{
            text: 'قبلی',
            classes: 'btn mx-1 btn-light',
            action: tour.back
        },
        {
            text: 'بعدی',
            classes: 'btn mx-1 btn-success',
            action: tour.next
        }
        ]
    });

if (document.querySelector('#tour-card-four'))
    tour.addStep({
        title: 'کارت چهار',
        text: `می‌توانید در اینجا وضعیت کاربری که در حال حاضر آنلاین است را ببینید.`,
        attachTo: {
            element: '#tour-card-four',
            on: 'bottom'
        },
        buttons: [{
            text: 'قبلی',
            classes: 'btn mx-1 btn-light',
            action: tour.back
        },
        {
            text: 'بعدی',
            classes: 'btn mx-1 btn-success',
            action: tour.next
        }
        ]
    });




if (document.querySelector('#thankyou-tour'))
    tour.addStep({
        title: 'ممنون از شما',
        text: 'در اینجا می توانید پوسته های تم و سایر ویژگی ها را تغییر دهید.',
        attachTo: {
            element: '#thankyou-tour',
            on: 'bottom'
        },
        buttons: [{
            text: 'قبلی',
            classes: 'btn mx-1 btn-light',
            action: tour.back
        },
        {
            text: 'ممنون از شما!',
            classes: 'btn mx-1 btn-primary',
            action: tour.complete
        }
        ]
    });

tour.start();