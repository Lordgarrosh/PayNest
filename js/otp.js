$(document).ready(function () {
    $(document).on('keyup', '.otp-field', function (e) {
        if (e.key >= 0 && e.key <=9) {
            setTimeout(() => {
                $(this).next('.otp-field').focus();
            }, 80);
        }
    });
});