<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

function set_active($route, $output = 'active')
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? $output : '';
    }
    return Request::path() == $route ? $output : '';
}

function confLocale() {
    setlocale(LC_TIME, 'id_ID');
    Carbon::setLocale('id');
}
