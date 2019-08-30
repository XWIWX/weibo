<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     * 指示是否应在响应上设置XSRF-TOKEN cookie。
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     * 应该排除在CSRF验证之外的uri。
     * @var array
     */
    protected $except = [
        //
    ];
}
