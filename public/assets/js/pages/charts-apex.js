//  line chart datalabel

const fa_locale = {
    "name": "fa",
    "options": {
      "months": [
        "فروردین",
        "اردیبهشت",
        "خرداد",
        "تیر",
        "مرداد",
        "شهریور",
        "مهر",
        "آبان",
        "آذر",
        "دی",
        "بهمن",
        "اسفند"
      ],
      "shortMonths": [
        "فرو",
        "ارد",
        "خرد",
        "تیر",
        "مرد",
        "شهر",
        "مهر",
        "آبا",
        "آذر",
        "دی",
        "بهمـ",
        "اسفـ"
      ],
      "days": [
        "یکشنبه",
        "دوشنبه",
        "سه شنبه",
        "چهارشنبه",
        "پنجشنبه",
        "جمعه",
        "شنبه"
      ],
      "shortDays": ["ی", "د", "س", "چ", "پ", "ج", "ش"],
      "toolbar": {
        "exportToSVG": "دانلود SVG",
        "exportToPNG": "دانلود PNG",
        "exportToCSV": "دانلود CSV",
        "menu": "منو",
        "selection": "انتخاب",
        "selectionZoom": "بزرگنمایی انتخابی",
        "zoomIn": "بزرگنمایی",
        "zoomOut": "کوچکنمایی",
        "pan": "پیمایش",
        "reset": "بازنشانی بزرگنمایی"
      }
    }
  }

var options = {
    chart: {
        height: 380,
        type: 'line',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#556ee6', '#34c38f'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: [3, 3],
        curve: 'straight'
    },
    series: [{
        name: "زیاد - 2018",
        data: [26, 24, 32, 36, 33, 31, 33]
    },
    {
        name: "کم - 2018",
        data: [14, 11, 16, 12, 17, 13, 12]
    }
    ],
    title: {
        text: 'میانگین بالا & دمای پایین',
        align: 'left',
        style: {
            fontWeight: '500',
        },
    },
    grid: {
        row: {
            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.2
        },
        borderColor: '#9ca3af20'
    },
    markers: {
        style: 'inverted',
        size: 6
    },
    xaxis: {
        categories: ['دی', 'آذر', 'آبان', 'مهر', 'شهریور', 'مرداد', 'تیر'],
        title: {
            text: 'ماه'
        }
    },
    yaxis: {
        title: {
            text: 'دما'
        },
        min: 5,
        max: 40
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: false
            },
        }
    }]
}

var chart = new ApexCharts(
    document.querySelector("#line_chart_datalabel"),
    options
);

chart.render();


//  line chart datalabel

var options = {
    chart: {
        height: 380,
        type: 'line',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false,
        }
    },
    colors: ['#556ee6', '#f46a6a', '#34c38f'],
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: [3, 4, 3],
        curve: 'straight',
        dashArray: [0, 8, 5]
    },
    series: [{
        name: "مدت زمان جلسه",
        data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
    },
    {
        name: "نمایش صفحه",
        data: [36, 42, 60, 42, 13, 18, 29, 37, 36, 51, 32, 35]
    },
    {
        name: 'کل بازدیدها',
        data: [89, 56, 74, 98, 72, 38, 64, 46, 84, 58, 46, 49]
    }],
    title: {
        text: 'آمار های صفحه',
        align: 'left',
        style: {
            fontWeight: '500',
        },
    },
    markers: {
        size: 0,

        hover: {
            sizeOffset: 6
        }
    },
    xaxis: {
        categories: ['01 تیر', '02 تیر', '03 تیر', '04 تیر', '05 تیر', '06 تیر', '07 تیر', '08 تیر', '09 تیر',
            '10 تیر', '11 تیر', '12 تیر'
        ],
    },
    tooltip: {
        y: [{
            title: {
                formatter: function (val) {
                    return val + " (دقیقه)"
                }
            }
        }, {
            title: {
                formatter: function (val) {
                    return val + " برپایه سیشن"
                }
            }
        }, {
            title: {
                formatter: function (val) {
                    return val;
                }
            }
        }]
    },
    grid: {
        borderColor: '#9ca3af20',
    }
}

var chart = new ApexCharts(
    document.querySelector("#line_chart_dashed"),
    options
);

chart.render();

//   spline_area

var options = {
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
            show: false,
        },
        locales: [fa_locale], //or multi language like [fa, en]
        defaultLocale: 'fa',
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth',
        width: 3,
    },
    series: [{
        name: 'سری 1',
        data: [34, 40, 28, 52, 42, 109, 100]
    }, {
        name: 'سری 2',
        data: [32, 60, 34, 46, 34, 52, 41]
    }],
    colors: ['#556ee6', '#34c38f'],
    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
    },
    grid: {
        borderColor: '#9ca3af20',
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
}

var chart = new ApexCharts(
    document.querySelector("#spline_area"),
    options
);

chart.render();

// column chart

var options = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
        },
        locales: [fa_locale], //or multi language like [fa, en]
        defaultLocale: 'fa',
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '45%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'سود خالص',
        data: [46, 57, 59, 54, 62, 58, 64, 60, 66]
    }, {
        name: 'درآمد',
        data: [74, 83, 102, 97, 86, 106, 93, 114, 94]
    }, {
        name: 'جریان نقدی آزاد',
        data: [37, 42, 38, 26, 47, 50, 54, 55, 43]
    }],
    colors: ['#34c38f', '#556ee6', '#f46a6a'],
    xaxis: {
        categories: ['اسفند', 'بهمن', 'دی', 'آذر', 'آبان', 'مهر', 'شهریور', 'مرداد', 'تیر'],
    },
    yaxis: {
        title: {
            text: 'تومان $ (هزار)',
            style: {
                fontWeight: '500',
            },
        }
    },
    grid: {
        borderColor: '#9ca3af20',
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        y: {
            formatter: function (val) {
                return " هزار تومان " + val
            }
        }
    }
}

var chart = new ApexCharts(
    document.querySelector("#column_chart"),
    options
);

chart.render();


// column chart with datalabels

var options = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
        },
        locales: [fa_locale], //or multi language like [fa, en]
        defaultLocale: 'fa',
    },
    plotOptions: {
        bar: {
            dataLabels: {
                position: 'top', // top, center, bottom
            },
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val + "%";
        },
        offsetY: -22,
        style: {
            fontSize: '12px',
            colors: ["#304758"]
        }
    },
    series: [{
        name: 'تورم',
        data: [2.5, 3.2, 5.0, 10.1, 4.2, 3.8, 3, 2.4, 4.0, 1.2, 3.5, 0.8]
    }],
    colors: ['#556ee6'],
    grid: {
        borderColor: '#9ca3af20',
    },
    xaxis: {
        categories: ["اسفند", "بهمن", "دی", "آذر", "آبان", "مهر", "شهریور", "مرداد", "تیر", "خرداد", "اردیبهشت", "فروردین"],
        position: 'top',
        labels: {
            offsetY: -18,

        },
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        crosshairs: {
            fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
            }
        },
        tooltip: {
            enabled: true,
            offsetY: -35,

        }
    },
    fill: {
        gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [50, 0, 100, 100]
        },
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
            formatter: function (val) {
                return val + "%";
            }
        }

    },
    title: {
        text: 'تورم ماهانه آرژانتین',
        floating: true,
        offsetY: 330,
        align: 'center',
        style: {
            color: '#444',
            fontWeight: '500',
        }
    },
}

var chart = new ApexCharts(
    document.querySelector("#column_chart_datalabel"),
    options
);

chart.render();



// Bar chart

var options = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [{
        name: "سری 1",
        data: [380, 430, 450, 475, 550, 584, 780, 1100, 1220, 1365]
    }],
    colors: ['#34c38f'],
    grid: {
        borderColor: '#9ca3af20',
    },
    xaxis: {
        categories: ['کره جنوبی', 'کانادا', 'انگلستان', 'هلند', 'ایتالیا', 'فرانسه', 'ژاپن', 'ایالات متحده', 'چین', 'آلمان'],
    }
}

var chart = new ApexCharts(
    document.querySelector("#bar_chart"),
    options
);

chart.render();


// Mixed chart

var options = {
    chart: {
        height: 350,
        type: 'line',
        stacked: false,
        toolbar: {
            show: false
        },
        locales: [fa_locale], //or multi language like [fa, en]
        defaultLocale: 'fa',
    },
    stroke: {
        width: [0, 2, 4],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    colors: ['#f46a6a', '#556ee6', '#34c38f'],
    series: [{
        name: 'تیم الف',
        type: 'column',
        data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
    }, {
        name: 'تیم ب',
        type: 'area',
        data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
    }, {
        name: 'تیم پ',
        type: 'line',
        data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
    }],
    fill: {
        opacity: [0.85, 0.25, 1],
        gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: ['01/01/1403', '02/01/1403', '03/01/1403', '04/01/1403', '05/01/1403', '06/01/1403', '07/01/1403', '08/01/1403', '09/01/1403', '10/01/1403', '11/01/1403'],
    markers: {
        size: 0
    },
    xaxis: {
        type: 'datetime'
    },
    yaxis: {
        title: {
            text: 'نقطه ها',
        },
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " نقطه ها";
                }
                return y;

            }
        }
    },
    grid: {
        borderColor: '#9ca3af20'
    }
}

var chart = new ApexCharts(
    document.querySelector("#mixed_chart"),
    options
);

chart.render();


//  Radial chart

var options = {
    chart: {
        height: 370,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'مجموع',
                    formatter: function (w) {
                        // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                        return 249
                    }
                }
            }
        }
    },
    series: [44, 55, 67, 83],
    labels: ['کامپیوتر', 'تبلت', 'لپ تاپ', 'موبایل'],
    colors: ['#556ee6', '#34c38f', '#f46a6a', '#f1b44c'],

}

var chart = new ApexCharts(
    document.querySelector("#radial_chart"),
    options
);

chart.render();


// pie chart

var options = {
    chart: {
        height: 320,
        type: 'pie',
    },
    series: [44, 55, 41, 17, 15],
    labels: ["سری 1", "سری 2", "سری 3", "سری 4", "سری 5"],
    colors: ["#34c38f", "#556ee6", "#f46a6a", "#50a5f1", "#f1b44c"],
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
    },
    stroke: {
        colors: ['transparent']
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                height: 240
            },
            legend: {
                show: false
            },
        }
    }]

}

var chart = new ApexCharts(
    document.querySelector("#pie_chart"),
    options
);

chart.render();


// Donut chart

var options = {
    chart: {
        height: 320,
        type: 'donut',
    },
    series: [44, 55, 41, 17, 15],
    labels: ["سری 1", "سری 2", "سری 3", "سری 4", "سری 5"],
    colors: ["#34c38f", "#556ee6", "#f46a6a", "#50a5f1", "#f1b44c"],
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
    },
    stroke: {
        colors: ['transparent']
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                height: 240
            },
            legend: {
                show: false
            },
        }
    }]

}

var chart = new ApexCharts(
    document.querySelector("#donut_chart"),
    options
);

chart.render();