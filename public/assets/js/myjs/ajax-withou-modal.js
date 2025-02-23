function ajaxFormSubmit(formSelector, url) {
    $(formSelector).submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        let submitButton = $(this).find('button[type="submit"]');

        // Disable the submit button and change text
        submitButton.prop("disabled", true).text("در حال ثبت...");

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.type === "success") {
                    // $('#exampleModal').modal('hide'); // Hide modal on success
                    $(formSelector).trigger("reset");
                    toastr.success(data.msg); // Show success toast
                    location.reload();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $(formSelector).find('.invalid-feedback').remove(); // Remove old validation messages
                    $(formSelector).find('.is-invalid').removeClass('is-invalid'); // Reset invalid fields

                    $.each(errors, function (field, messages) {
                        let input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                    });

                    toastr.error("لطفاً خطاهای ورودی را بررسی کنید."); // Show error toast
                } else {
                    toastr.error("خطایی رخ داده است. لطفاً دوباره تلاش کنید."); // General error
                }
            },
            complete: function () {
                // Re-enable button after request completes
                submitButton.prop("disabled", false).text("ثبت");
            }
        });
    });
}
