<?php

if (!function_exists('showMessage')) {
    function showMessage($message, $type)
    {
        if ($message) {
            return redirect()->back()->with('success','Успешно '.$type);
        }else {
            return redirect()->back()->with('danger','Попробуйте позже !');
        }
    }
}

if (!function_exists('sendEmail')) {
    function sendEmail($subject, $message,$email)
    {
        $subject = $subject;
        $headers = "From: AeaLS.kz <support@fssarp.com>\r\nContent-type: text/html; charset=utf-8 \r\n";
        $d = mail($email, $subject, $message, $headers);
        if ($d) {
            return true;
        }
        return false;
    }
}
