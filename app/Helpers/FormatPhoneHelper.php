<?php

if (!function_exists('FormatPhoneHelper')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function FormatPhoneHelper($phone)
    {
        $phone = preg_replace("/^[1-9][0-9]*$/", "", $phone);
        /*return $phone;*/
        if (strlen($phone) == 10)
            return preg_replace("/(\d{3})(\d{3})(\d{4})/", "$1-$2-$3", $phone);
        elseif (strlen($phone) == 11)
            return preg_replace("/(\d{3})(\d{4})(\d{4})/", "$1-$2-$3", $phone);
        else
            return $phone;
    }
}
