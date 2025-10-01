jQuery(document).ready(function($) {
    'use strict';

    const popup = $('#sms-login-popup');
    const mobileInput = $('#sms-mobile-input');
    const otpInput = $('#sms-otp-input');
    const sendOtpBtn = $('#send-otp-button');
    const verifyOtpBtn = $('#verify-otp-button');
    const resendOtpBtn = $('#resend-otp-button');
    const step1 = $('#sms-step-1');
    const step2 = $('#sms-step-2');
    const messageDiv = $('#sms-login-messages');
    const countdownTimer = $('#countdown-timer');
    const otpTimer = $('#otp-timer');
    const enteredMobileSpan = $('#entered-mobile');
    const closeBtn = $('.sms-login-popup-close');
    const overlay = $('.sms-login-popup-overlay');

    let timer;

    // Use the specific class added to the widget link
    const loginTrigger = '.sms-login-trigger';

    function openPopup() {
        popup.fadeIn(200);
    }

    function closePopup() {
        popup.fadeOut(200);
        resetForm();
    }

    function resetForm() {
        step1.show();
        step2.hide();
        mobileInput.val('');
        otpInput.val('');
        messageDiv.hide().removeClass('success error').text('');
        clearInterval(timer);
        resendOtpBtn.hide();
        otpTimer.hide();
    }

    function showMessage(message, isSuccess) {
        messageDiv.text(message)
            .removeClass(isSuccess ? 'error' : 'success')
            .addClass(isSuccess ? 'success' : 'error')
            .fadeIn();
    }

    function startTimer(duration) {
        let timeLeft = duration;
        countdownTimer.text(timeLeft);
        otpTimer.show();
        resendOtpBtn.hide();

        timer = setInterval(function() {
            timeLeft--;
            countdownTimer.text(timeLeft);
            if (timeLeft <= 0) {
                clearInterval(timer);
                otpTimer.hide();
                resendOtpBtn.show();
            }
        }, 1000);
    }

    // --- Event Handlers ---

    $(document).on('click', loginTrigger, function(e) {
        e.preventDefault();
        openPopup();
    });

    closeBtn.on('click', function(e) {
        e.preventDefault();
        closePopup();
    });

    overlay.on('click', function(e) {
        closePopup();
    });

    sendOtpBtn.on('click', function() {
        const mobile = mobileInput.val();
        if (!mobile.match(/^09[0-9]{9}$/)) {
            showMessage(ajax_object.i18n.valid_mobile, false);
            return;
        }

        $(this).prop('disabled', true).text(ajax_object.i18n.sending);

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'send_otp',
                mobile: mobile
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.data.message, true);
                    step1.hide();
                    step2.show();
                    enteredMobileSpan.text(mobile);
                    startTimer(60);
                } else {
                    showMessage(response.data.message, false);
                }
            },
            error: function() {
                showMessage(ajax_object.i18n.error, false);
            },
            complete: function() {
                sendOtpBtn.prop('disabled', false).text(ajax_object.i18n.send_code);
            }
        });
    });

    resendOtpBtn.on('click', function() {
        sendOtpBtn.click();
    });

    verifyOtpBtn.on('click', function() {
        const mobile = mobileInput.val();
        const otpCode = otpInput.val();

        if (!otpCode) {
            showMessage(ajax_object.i18n.enter_otp, false);
            return;
        }

        $(this).prop('disabled', true).text(ajax_object.i18n.verifying);

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'verify_otp',
                mobile: mobile,
                otp_code: otpCode
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.data.message, true);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    showMessage(response.data.message, false);
                }
            },
            error: function() {
                showMessage(ajax_object.i18n.error, false);
            },
            complete: function() {
                verifyOtpBtn.prop('disabled', false).text(ajax_object.i18n.login);
            }
        });
    });
});