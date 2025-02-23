//Basic
if (document.getElementById("sweetalert-basic"))
  document
    .getElementById("sweetalert-basic")
    .addEventListener("click", function () {
      Swal.fire({
        title: "هر کس می تواند از کامپیوتر استفاده کند",
        buttonsStyling: false,
        showCloseButton: false,
        confirmButtonText: "باشه",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
        },
      });
    });

//A title with a text under
if (document.getElementById("sweetalert-title"))
  document
    .getElementById("sweetalert-title")
    .addEventListener("click", function () {
      Swal.fire({
        title: "اینترنت ؟",
        text: "هنوزم این طرفا پیدا میشه ؟",
        icon: "question",
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
        },
        buttonsStyling: false,
        showCloseButton: false,
      });
    });

//Success Message
if (document.getElementById("sweetalert-success"))
  document
    .getElementById("sweetalert-success")
    .addEventListener("click", function () {
      Swal.fire({
        title: "آفرین !",
        text: "روی دکمه کلیک کردی !",
        icon: "success",
        showCancelButton: true,
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs me-2 mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
        },
        buttonsStyling: false,
        showCloseButton: false,
      });
    });

//error Message
if (document.getElementById("sweetalert-error"))
  document
    .getElementById("sweetalert-error")
    .addEventListener("click", function () {
      Swal.fire({
        title: "اووپس...",
        text: "یچیزی اشتباهه !",
        icon: "error",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
          footer: "pb-4",
        },
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
        buttonsStyling: false,
        footer: '<a href="">چرا من این مشکل رو دارم ؟</a>',
        showCloseButton: false,
      });
    });

//info Message
if (document.getElementById("sweetalert-info"))
  document
    .getElementById("sweetalert-info")
    .addEventListener("click", function () {
      Swal.fire({
        title: "اووپس...",
        text: "یچیزی اشتباهه !",
        icon: "info",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
          footer: "pb-4",
        },
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
        buttonsStyling: false,
        footer: '<a href="">چرا من این مشکل رو دارم ؟</a>',
        showCloseButton: false,
      });
    });

//Warning Message
if (document.getElementById("sweetalert-warning"))
  document
    .getElementById("sweetalert-warning")
    .addEventListener("click", function () {
      Swal.fire({
        title: "اووپس...",
        text: "یچیزی اشتباهه !",
        icon: "warning",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
          footer: "pb-4",
        },
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
        buttonsStyling: false,
        footer: '<a href="">چرا من این مشکل رو دارم ؟</a>',
        showCloseButton: false,
      });
    });

// long content
if (document.getElementById("sweetalert-longcontent"))
  document
    .getElementById("sweetalert-longcontent")
    .addEventListener("click", function () {
      Swal.fire({
        imageUrl: "https://placeholder.pics/svg/300x1500",
        imageHeight: 1500,
        imageAlt: "A tall image",
        confirmButtonClass: "btn bg-primary text-white w-xs mt-2",
        buttonsStyling: false,
        showCloseButton: false,
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
          footer: "pb-4",
        },
        confirmButtonText: "باشه",
        cancelButtonText: "لغو",
      });
    });

//Parameter
if (document.getElementById("sweetalert-params"))
  document
    .getElementById("sweetalert-params")
    .addEventListener("click", function () {
      Swal.fire({
        title: "آیا مطمعنی ؟",
        text: "قادر به برگشت نیستی",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "بله ، حذف کن",
        cancelButtonText: "نه ، لغو",
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs me-2 mt-2",
          cancelButton: "btn bg-danger text-white w-xs mt-2",
          footer: "pb-4",
        },
        buttonsStyling: false,
        showCloseButton: false,
      }).then(function (result) {
        if (result.value) {
          Swal.fire({
            title: "حذف شد",
            text: "شما فایل را حذف کردید",
            icon: "success",
            customClass: {
              confirmButton: "btn bg-primary text-white w-xs mt-2",
            },
            buttonsStyling: false,
          });
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          Swal.fire({
            title: "لغو شد",
            text: "فایل شما امن است",
            icon: "error",
            customClass: {
              confirmButton: "btn bg-primary text-white w-xs mt-2",
            },
            buttonsStyling: false,
          });
        }
      });
    });

//Custom Image
if (document.getElementById("sweetalert-image"))
  document
    .getElementById("sweetalert-image")
    .addEventListener("click", function () {
      Swal.fire({
        title: "شیرینی",
        text: "مدال با یک عکس اختصاصی",
        imageUrl: "assets/images/logo-sm.png",
        imageHeight: 40,
        customClass: {
          confirmButton: "btn bg-primary text-white w-xs mt-2",
        },
        buttonsStyling: false,
        animation: false,
        showCloseButton: false,
      });
    });
