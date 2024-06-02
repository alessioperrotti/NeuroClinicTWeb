function doElemValidation(formElementId, actionUrl, formId) {
    var formElement = $("#" + formElementId);
    var formData = {};
    formData[formElementId] = formElement.val();
    formData['_token'] = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: actionUrl,
        method: 'POST',
        data: formData,
        success: function(response) {
            $("#" + formElementId).removeClass('border-red-500').addClass('border-green-500');
            $("#" + formElementId).siblings('.error').remove();
        },
        error: function(response) {
            var errors = response.responseJSON.errors;
            $("#" + formElementId).removeClass('border-green-500').addClass('border-red-500');
            $("#" + formElementId).siblings('.error').remove();
            if (errors[formElementId]) {
                $("#" + formElementId).after('<span class="error text-red-500">' + errors[formElementId][0] + '</span>');
            }
        }
    });
}

function doFormValidation(actionUrl, formId) {
    var formData = $("#" + formId).serialize();

    $.ajax({
        url: actionUrl,
        method: 'POST',
        data: formData,
        success: function(response) {
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        },
        error: function(response) {
            var errors = response.responseJSON.errors;
            $(".error").remove();
            for (var key in errors) {
                $("#" + key).addClass('border-red-500');
                $("#" + key).after('<span class="error text-red-500">' + errors[key][0] + '</span>');
            }
        }
    });
}