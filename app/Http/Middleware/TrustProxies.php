<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Los proxies confiables para esta aplicación.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Los encabezados que se pueden usar para detectar proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}