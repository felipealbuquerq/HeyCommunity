<?php

/**
 * Set Nav Active
 */
function setNavActive($match)
{
    if (is_array($match)) {
        foreach ($match as $item) {
            if (request()->is($item)) {
                return 'active';
            }
        }
    } else {
        return request()->is($match) ? 'active' : '';
    }
}

/**
 * Set Params Active
 */
function setParamActive($paramName, $value)
{
    if (request()->get($paramName) == $value) {
        return 'active';
    }
}

/**
 * Set Disabled
 */
function setDisabled($condition)
{
    if ($condition) {
        return 'disabled';
    }
}

/**
 * Is Super Admin
 */
function isSuperAdmin()
{
    return (Auth::check() && Auth::user()->is_super_admin) ? true : false;
}

/**
 *  String To One Line
 */
function strToOneLine($string)
{
    $string = preg_replace('/\s+/', ' ',$string);
    return $string;
}

/**
 * Get Back To Index Route
 */
function getBackToIndexRoute()
{
    $routeName = Request::route()->getName();
    $routeRootName = strstr($routeName, '.', true);

    $controllerNames = [
        'news',
        'column',
        'post',
        'topic',
        'activity',
    ];

    if (in_array($routeRootName, $controllerNames)) {
        if ($routeRootName == 'column') return 'columnist.index';

        return $routeRootName . '.index';
    } else {
        return $routeName ?: 'home';
    }
}

/**
 * Get Form Value For Model Create And Edit
 */
function formValue($object, $key)
{
    if (is_object($object)) {
        return $object->$key;
    } else {
        return null;
    }
}

/**
 * Make CDN Asset Path
 */
function makeCdnAssetPath($path, $params = '?imageView2/2/w/1000')
{
    if (env('CDN_ENABLE')) {
        if (!str_is('http', $path)) {
            return env('CDN_DOMAIN') . '/' . $path . $params;
        }
    }

    return $path;
}
