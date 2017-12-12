<?php

/**
 * Convert the current route name to a string with short bars (-)..
 *
 * @return string
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}