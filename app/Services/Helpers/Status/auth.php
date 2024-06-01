<?php

if (!function_exists("errAuthChangePassword")) {
    function errAuthChangePassword($internalMsg = "")
    {
        error(500, "Unable to change password!", $internalMsg);
    }
}
