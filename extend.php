<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright Pixel federation
 * @license:  Internal use only
 */

use Flarum\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;
use PixelFederation\RedisSession\Provider;
use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Locales(__DIR__.'/locale')),
    function (Dispatcher $events, Application $app) {
        $app->register(Provider\SessionProvider::class);
    }
];
