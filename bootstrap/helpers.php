<?php

use Illuminate\Support\Facades\Route;

/**
 * 将当前请求路由转换为 CSS 类名称
 * @return string|string[]|null
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}