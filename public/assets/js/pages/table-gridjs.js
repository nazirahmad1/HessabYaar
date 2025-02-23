/*
Template Name: Konrix - Responsive 5 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: datatable js
*/

const faIR = {
    search: { placeholder: "جست‌جو برای..." },
    sort: { sortAsc: "مرتب سازی صعودی", sortDesc: "مرتب سازی نزولی" },
    pagination: {
      previous: "قبلی",
      next: "بعدی",
      navigate: function (e, r) {
        return "صفحه " + e + " از " + r;
      },
      page: function (e) {
        return "صفحه " + e;
      },
      showing: "نمایش",
      of: "از",
      to: "تا",
      results: "نتایج",
    },
    loading: "در حال دریافت...",
    noRecordsFound: "نتیجه‌ای یافت نشد.",
    error: "دریافت اطلاعات با خطا مواجه شد.",
  }

class GridDatatable {

    init() {
        this.basicTableInit();
    }

    basicTableInit() {

        // Basic Table
        if (document.getElementById("table-gridjs"))
            new gridjs.Grid({
                language: faIR,
                columns: [{
                    name: 'ID',
                    formatter: (function (cell) {
                        return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
                    })
                },
                    "نام",
                {
                    name: 'ایمیل',
                    formatter: (function (cell) {
                        return gridjs.html('<a href="">' + cell + '</a>');
                    })
                },
                    "موقعیت", "کمپانی", "کشور",
                {
                    name: 'عملیات',
                    width: '120px',
                    formatter: (function (cell) {
                        return gridjs.html("<a href='#' class='text-reset text-decoration-underline'>" + "عملیات" + "</a>");
                    })
                },
                ],
                pagination: {
                    limit: 5
                },
                sort: true,
                search: true,
                data: [
                    ["01", "جاناتان", "jonathan@example.com", "معمار پیاده‌سازی سنیور", "شرکت هاوک", "واتیکان"],
                    ["02", "هارولد", "harold@example.com", "هماهنگ‌کننده خلاقانه پیشین", "شرکت متز", "ایران"],
                    ["03", "شنان", "shannon@example.com", "همکاری ارثی عملکردی", "گروه زملاک", "جورجیای جنوبی"],
                    ["04", "رابرت", "robert@example.com", "تکنسین حساب محصول", "هوگر", "سان مارینو"],
                    ["05", "نوئل", "noel@example.com", "مدیر داده‌های مشتری", "هاول - ریپین", "آلمان"],
                    ["06", "تریسی", "traci@example.com", "مدیر شناسایی شرکتی", "کولپین - گلدنر", "وانواتو"],
                    ["07", "کری", "kerry@example.com", "همکاری برنامه‌های اولیه", "فینی، لانگورت و ترامبلی", "نیجر"],
                    ["08", "پتسی", "patsy@example.com", "مدیر تضمین پویا", "گروه استریک", "نیووی"],
                    ["09", "کثی", "cathy@example.com", "مدیر داده‌های مشتری", "ابرت، شمبرگر و جانستون", "مکزیک"],
                    ["10", "تایرون", "tyrone@example.com", "لیزون واکنش سنیور", "رینور، رولفسون و داگرتی", "قطر"]
                ]                
            }).render(document.getElementById("table-gridjs"));

        // card Table
        if (document.getElementById("table-card"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی", "کشور"],
                sort: true,
                pagination: {
                    limit: 5
                },
                data: [
                    ["جاناتان", "jonathan@example.com", "معمار پیاده‌سازی سنیور", "شرکت هاوک", "واتیکان"],
                    ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقانه پیشین", "شرکت متز", "ایران"],
                    ["شنان", "shannon@example.com", "همکاری ارثی عملکردی", "گروه زملاک", "جورجیای جنوبی"],
                    ["رابرت", "robert@example.com", "تکنسین حساب محصول", "هوگر", "سان مارینو"],
                    ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "هاول - ریپین", "آلمان"],
                    ["تریسی", "traci@example.com", "مدیر شناسایی شرکتی", "کولپین - گلدنر", "وانواتو"],
                    ["کری", "kerry@example.com", "همکاری برنامه‌های اولیه", "فینی، لانگورت و ترامبلی", "نیجر"],
                    ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "گروه استریک", "نیووی"],
                    ["کثی", "cathy@example.com", "مدیر داده‌های مشتری", "ابرت، شمبرگر و جانستون", "مکزیک"],
                    ["تایرون", "tyrone@example.com", "لیزون واکنش سنیور", "رینور، رولفسون و داگرتی", "قطر"]
                ]                
            }).render(document.getElementById("table-card"));


        // pagination Table
        if (document.getElementById("table-pagination"))
            new gridjs.Grid({
            language: faIR,
                columns: [{
                    name: 'ID',
                    width: '120px',
                    formatter: (function (cell) {
                        return gridjs.html('<a href="" class="fw-medium">' + cell + '</a>');
                    })
                }, "نام", "تاریخ", "مجموع", "وضعیت",
                {
                    name: 'عملیات',
                    width: '100px',
                    formatter: (function (cell) {
                        return gridjs.html("<button type='button' class='btn btn-sm btn-light'>" +
                            "عمیلات" +
                            "</button>");
                    })
                },
                ],
                pagination: {
                    limit: 5
                },

                data: [
                    ["#VL2111", "جاناتان", "07 تیر 1403", "12 تومان", "پرداخت شده"],
                    ["#VL2110", "هارولد", "07 تیر 1403", "15 تومان", "پرداخت شده"],
                    ["#VL2109", "شنان", "06 تیر 1403", "20 تومان", "بازپرداخت"],
                    ["#VL2108", "رابرت", "05 تیر 1403", "60 تومان", "پرداخت شده"],
                    ["#VL2107", "نوئل", "05 تیر 1403", "17 تومان", "پرداخت شده"],
                    ["#VL2106", "تریسی", "04 تیر 1403", "25 تومان", "پرداخت شده"],
                    ["#VL2105", "کری", "04 تیر 1403", "40 تومان", "پرداخت شده"],
                    ["#VL2104", "پتسی", "04 تیر 1403", "20 تومان", "بازپرداخت"],
                    ["#VL2103", "کثی", "03 تیر 1403", "17 تومان", "پرداخت شده"],
                    ["#VL2102", "تایرون", "03 تیر 1403", "60 تومان", "پرداخت شده"]
                ]                
            }).render(document.getElementById("table-pagination"));

        // search Table
        if (document.getElementById("table-search"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی", "کشور"],
                pagination: {
                    limit: 5
                },
                search: true,
                data: [
                    ["جاناتان", "jonathan@example.com", "معمار اجرایی ارشد", "اسنپ", "مرکز واتیکان"],
                    ["هارولد", "harold@example.com", "مدیر اجرایی خلاق", "دیجیکالا", "ایران"],
                    ["شنان", "shannon@example.com", "همکاری عملکرد ارثی", "راست چین", "جورجیای جنوبی"],
                    ["رابرت", "robert@example.com", "تکنسین حسابداری محصولات", "تپسی", "سان مارینو"],
                    ["نوئل", "noel@example.com", "مدیر داده مشتری", "بازار", "آلمان"],
                    ["تریسی", "traci@example.com", "مدیریت هویت شرکتی", "گوگل", "وانواتو"],
                    ["کری", "kerry@example.com", "مدیر برنامه‌های کاربردی", "اپل", "نیجر"],
                    ["پتسی", "patsy@example.com", "مدیریت اطمینان پویا", "مایکروسافت", "نیوو"],
                    ["کثی", "cathy@example.com", "مدیر داده مشتری", "آمازون", "مکزیک"],
                    ["تایرون", "tyrone@example.com", "نماینده پاسخ ارشد", "متا", "قطر"]
                ]                
            }).render(document.getElementById("table-search"));

        // Sorting Table
        if (document.getElementById("table-sorting"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی", "کشور"],
                pagination: {
                    limit: 5
                },
                sort: true,
                data: [
                    ["جاناتان", "jonathan@example.com", "معمار اجرایی ارشد", "اسنپ", "مرکز واتیکان"],
                    ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقانه پیشرفته", "دیجیکالا", "ایران"],
                    ["شنان", "shannon@example.com", "همکاری عملکرد ارثی", "راست چین", "جورجیای جنوبی"],
                    ["رابرت", "robert@example.com", "تکنسین حسابداری محصولات", "تپسی", "سان مارینو"],
                    ["نوئل", "noel@example.com", "مدیر داده مشتری", "بازار", "آلمان"],
                    ["تریسی", "traci@example.com", "مدیریت هویت شرکتی", "گوگل", "وانواتو"],
                    ["کری", "kerry@example.com", "مدیر برنامه‌های کاربردی", "اپل", "نیجر"],
                    ["پتسی", "patsy@example.com", "مدیریت اطمینان پویا", "مایکروسافت", "نیوو"],
                    ["کثی", "cathy@example.com", "مدیر داده مشتری", "آمازون", "مکزیک"],
                    ["تایرون", "tyrone@example.com", "نماینده پاسخ ارشد", "متا", "قطر"]
                ]                
            }).render(document.getElementById("table-sorting"));


        // Loading State Table
        if (document.getElementById("table-loading-state"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی", "کشور"],
                pagination: {
                    limit: 5
                },
                sort: true,
                data: function () {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve([
                                ["جاناتان", "jonathan@example.com", "معمار اجرایی ارشد", "اسنپ", "مرکز واتیکان"],
                                ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقانه پیشرفته", "دیجیکالا", "ایران"],
                                ["شنان", "shannon@example.com", "همکاری عملکرد ارثی", "راست چین", "جورجیای جنوبی"],
                                ["رابرت", "robert@example.com", "تکنسین حسابداری محصولات", "تپسی", "سان مارینو"],
                                ["نوئل", "noel@example.com", "مدیر داده مشتری", "بازار", "آلمان"],
                                ["تریسی", "traci@example.com", "مدیریت هویت شرکتی", "گوگل", "وانواتو"],
                                ["کری", "kerry@example.com", "مدیر برنامه‌های کاربردی", "اپل", "نیجر"],
                                ["پتسی", "patsy@example.com", "مدیریت اطمینان پویا", "مایکروسافت", "نیوو"],
                                ["کثی", "cathy@example.com", "مدیر داده مشتری", "آمازون", "مکزیک"],
                                ["تایرون", "tyrone@example.com", "نماینده پاسخ ارشد", "متا", "قطر"]
                            ])
                        }, 2000);
                    });
                }
            }).render(document.getElementById("table-loading-state"));


        // Fixed Header
        if (document.getElementById("table-fixed-header"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی", "کشور"],
                sort: true,
                pagination: true,
                fixedHeader: true,
                height: '400px',
                data:[
                    ["Jonathan", "jonathan@example.com", "معمار اجرایی ارشد", "اسنپ", "مرکز واتیکان"],
                    ["Harold", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "دیجیکالا", "ایران"],
                    ["Shannon", "shannon@example.com", "همکاری عملکرد ارثی", "راست چین", "جورجیای جنوبی"],
                    ["Robert", "robert@example.com", "تکنسین حسابداری محصولات", "تپسی", "سان مارینو"],
                    ["Noel", "noel@example.com", "مدیر داده مشتری", "بازار", "آلمان"],
                    ["Traci", "traci@example.com", "مدیریت هویت شرکتی", "گوگل", "وانواتو"],
                    ["Kerry", "kerry@example.com", "مدیر برنامه‌های کاربردی", "اپل", "نیجر"],
                    ["Patsy", "patsy@example.com", "مدیریت اطمینان پویا", "مایکروسافت", "نیوو"],
                    ["Cathy", "cathy@example.com", "مدیر داده مشتری", "آمازون", "مکزیک"],
                    ["Tyrone", "tyrone@example.com", "نماینده پاسخ ارشد", "متا", "قطر"]
                ]                
            }).render(document.getElementById("table-fixed-header"));


        // Hidden Columns
        if (document.getElementById("table-hidden-column"))
            new gridjs.Grid({
                language: faIR,
                columns: ["نام", "ایمیل", "موقعیت", "کمپانی",
                    {
                        name: 'Country',
                        hidden: true
                    },
                ],
                pagination: {
                    limit: 5
                },
                sort: true,
                data:[
                    ["جاناتان", "jonathan@example.com", "معمار اجرایی", "شرکت هاوک", "واتیکان"],
                    ["هارولد", "harold@example.com", "هماهنگ کننده خلاقیت پیشرو", "شرکت متز", "ایران"],
                    ["شنن", "shannon@example.com", "همکاری عملکرد ارثی", "گروه زملاک", "جورجیای جنوبی"],
                    ["رابرت", "robert@example.com", "تکنسین حسابداری محصولات", "هوگر", "سان مارینو"],
                    ["نوئل", "noel@example.com", "مدیر داده مشتری", "هاول - ریپین", "آلمان"],
                    ["تریسی", "traci@example.com", "مدیریت هویت شرکتی", "کوئلپین - گلدنر", "وانواتو"],
                    ["کری", "kerry@example.com", "مدیر برنامه‌های کاربردی", "فینی، لنگورث و ترمبلی", "نیجر"],
                    ["پتسی", "patsy@example.com", "مدیریت اطمینان پویا", "گروه استرایچ", "نیوو"],
                    ["کتی", "cathy@example.com", "مدیر داده مشتری", "ابرت، شمبرگر و جانستون", "مکزیک"],
                    ["تایرون", "tyrone@example.com", "نماینده پاسخ ارشد", "رینور، رالفسون و دوگرتی", "قطر"]
                ]
            }).render(document.getElementById("table-hidden-column"));


    }

}

document.addEventListener('DOMContentLoaded', function (e) {
    new GridDatatable().init();
});