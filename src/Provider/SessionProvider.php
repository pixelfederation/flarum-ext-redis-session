<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Settings\SettingsRepositoryInterface;
use PixelFederation\RedisSession\Redis\Client\ClientFactory;
use PixelFederation\RedisSession\Redis\Client\ClientFactoryInterface;
use PixelFederation\RedisSession\Session\Storage\Handler\RedisSessionHandler;
use PixelFederation\RedisSession\Session\Storage\Handler\SessionHandlerFactory;
use PixelFederation\RedisSession\Session\Storage\Handler\SessionHandlerFactoryInterface;
use Predis\Connection\Factory;
use Predis\Connection\FactoryInterface;

/**
 * override session hanlder to redis
 */
final class SessionProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        // redis connection factory
        $this->app->singleton(FactoryInterface::class, function () {
            return new Factory();
        });

        // redis client factory
        $this->app->singleton(ClientFactoryInterface::class, function () {
            return new ClientFactory(
                $this->app->make(FactoryInterface::class),
                $this->app->make(SettingsRepositoryInterface::class)
            );

        });

        // session handler factory
        $this->app->singleton(SessionHandlerFactoryInterface::class, function () {
            return new SessionHandlerFactory(
                $this->app->make(ClientFactoryInterface::class),
                $this->app->make(SettingsRepositoryInterface::class)
            );
        });

        /**
         * @see \Flarum\User\SessionServiceProvider
         */
        $this->app->singleton('session.handler', function ($app) {
            return $this->app->get(SessionHandlerFactoryInterface::class)->create();
        });
    }
}
