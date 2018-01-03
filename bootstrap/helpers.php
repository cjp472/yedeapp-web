<?php

/**
 * Convert the current route name to a string with short bars (-).
 *
 * @return string
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * Make the content's description by trimming 200 charaters from its head.
 *
 * @param  string $value
 * @param  integer $length
 * @return string
 */
function make_desc($value, $length = 200)
{
    $desc = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));

    return str_limit($desc, $length);
}

/**
 * Make an <a></a> link.
 *
 * @param  string  $inner
 * @param  string  $title
 * @param  string  $href
 * @param  string  $target
 * @return string
 */
function make_link($inner, $href = '#', $title = '', $target = '_blank') {
    return '<a href="'.$href.'" title="'.$title.'" target="'.$target.'">'.$inner.'</a>';
}