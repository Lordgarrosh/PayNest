$(document).ready(function () {

    const otpFields = $('.otp-field');

    // INPUT
    $(document).on('input', '.otp-field', function () {

        // allow digits only
        this.value = this.value.replace(/\D/g, '');

        // move to next field
        if (this.value.length === 1) {
            $(this).next('.otp-field').focus();
        }

    });

    // BACKSPACE
    $(document).on('keydown', '.otp-field', function (e) {

        if (e.key === "Backspace") {

            // if current field empty -> go previous
            if ($(this).val() === '') {
                $(this).prev('.otp-field').focus().val('');
            } 
            else {
                // clear current field
                $(this).val('');
            }

        }

    });

    // PASTE FULL OTP
    $(document).on('paste', '.otp-field', function (e) {

        e.preventDefault();

        let pastedData = (e.originalEvent || e).clipboardData
            .getData('text')
            .replace(/\D/g, '');

        otpFields.each(function(index) {
            $(this).val(pastedData[index] || '');
        });

        // focus last filled
        otpFields.eq(pastedData.length - 1).focus();

    });

});