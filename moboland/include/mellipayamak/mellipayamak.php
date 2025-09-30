<?php
function sendMelliPayamakPattern($to)
{
    ini_set("soap.wsdl_cache_enabled", "0");
    $sms = new SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl", array("encoding" => "UTF-8"));

    // دریافت مقادیر ذخیره‌شده از دیتابیس وردپرس
    $username = get_option('mellipayamak_username');
    $password = get_option('mellipayamak_password');
    $bodyId   = get_option('mellipayamak_bodyid');

    // تولید یک کد ۴ رقمی رندوم
    $randomCode = rand(1000, 9999);

    $data = array(
        "username" => $username,
        "password" => $password,
        "text" => [$randomCode], // ارسال کد ۴ رقمی به‌عنوان متن پیام
        "to" => $to,
        "bodyId" => $bodyId
    );

    $send_Result = $sms->SendByBaseNumber($data)->SendByBaseNumberResult;

    // کد تولید شده را در پاسخ برمی‌گرداند
    return [
        'result' => $send_Result,
        'code' => $randomCode
    ];
}
