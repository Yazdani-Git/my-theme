<div id="sms-login-popup" class="sms-login-popup-container" style="display: none;">
    <div class="sms-login-popup-overlay"></div>
    <div class="sms-login-popup-content">
        <a href="#" class="sms-login-popup-close">&times;</a>
        <h3>ورود | ثبت نام با شماره موبایل</h3>

        <div class="sms-login-form">
            <div id="sms-step-1">
                <p>لطفا شماره موبایل خود را وارد کنید</p>
                <input type="tel" id="sms-mobile-input" placeholder="مثال: 09123456789">
                <button id="send-otp-button" class="button">ارسال کد تایید</button>
            </div>

            <div id="sms-step-2" style="display: none;">
                <p>کد تایید ارسال شده به شماره <span id="entered-mobile"></span> را وارد کنید.</p>
                <input type="text" id="sms-otp-input" placeholder="کد تایید">
                <button id="verify-otp-button" class="button">ورود</button>
                <p id="otp-timer" style="display: none;">ارسال مجدد کد تا <span id="countdown-timer">60</span> ثانیه دیگر</p>
                <button id="resend-otp-button" style="display: none;">ارسال مجدد</button>
            </div>

            <div id="sms-login-messages" class="sms-login-messages" style="display: none;"></div>
        </div>
    </div>
</div>