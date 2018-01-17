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
use PixelFederation\RedisSession\Listener;
use PixelFederation\RedisSession\Provider;

return function (Dispatcher $events, Application $app) {
    $events->subscribe(Listener\AddClientAssets::class);
    $events->listen(ConfigureLocales::class, function (ConfigureLocales $event) {
        $event->loadLanguagePackFrom(__DIR__);
    });
    $app->register(Provider\SessionProvider::class);
};
