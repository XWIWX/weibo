<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     * 此应用程序的可信代理。
     *
     * @var array|string
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     * 应该用于检测代理的标头。
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
