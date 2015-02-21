<?php
Validator::extend('check_password', function($attribute,$value,$parameters)
{
    return (Hash::check($value, Auth::user()->password));
});

Validator::extend('validate_time24', function($attribute,$value,$parameters)
{
    return preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $value);
});