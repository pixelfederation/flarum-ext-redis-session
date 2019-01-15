<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright Pixel federation
 * @license:  Internal use only
 */

use Flarum\Event\ConfigureLocales;
use Flarum\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;
use PixelFederation\RedisSession\Provider;
use Flarum\Extend\Frontend;
use Flarum\Extend\Locales;

return [
    (new Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Locales(__DIR__.'/locale')),
    function (Dispatcher $events, Application $app) {
        $app->register(Provider\SessionProvider::class);
    }
];
