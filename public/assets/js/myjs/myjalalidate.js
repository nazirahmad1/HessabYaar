

     flatpickr("#basic-datepicker", {
          dateFormat: "Y/m/d",
          "locale": "fa",
     });
     flatpickr("#datetime-datepicker", {
          dateFormat: "Y/m/d",
          "locale": "fa",
     });
     flatpickr("#range-datepicker", {
          dateFormat: "Y/m/d",
          "locale": "fa",
          "plugins": [new rangePlugin({ input: "#toDate" })]
     });
     flatpickr("#multiple-datepicker", {
          mode: "multiple",
          dateFormat: "Y/m/d",
          conjunction: " :: ",
          "locale": "fa",
     });

