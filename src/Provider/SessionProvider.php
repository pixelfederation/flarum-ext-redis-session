<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Http\CookieFactory;
use Flarum\Http\Middleware\StartSession;
use Flarum\Settings\SettingsRepositoryInterface;
use PixelFederation\RedisSession\Redis\Client\ClientFactory;
use PixelFederation\RedisSession\Redis\Client\ClientFactoryInterface;
use PixelFederation\RedisSession\Session\SessionFactory;
use PixelFederation\RedisSession\Session\SessionFactoryInterface;
use PixelFederation\RedisSession\Session\Storage\Handler\SessionHandlerFactory;
use PixelFederation\RedisSession\Session\Storage\Handler\SessionHandlerFactoryInterface;
use PixelFederation\RedisSession\Session\Storage\SessionStorageFactory;
use PixelFederation\RedisSession\Session\Storage\SessionStorageFactoryInterface;
use Predis\Connection\Factory;
use Predis\Connection\FactoryInterface;

/**
 *
 */
final class SessionProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(FactoryInterface::class, function () {
            return new Factory();
        });
        $this->app->singleton(ClientFactoryInterface::class, function () {
            return new ClientFactory(
                $this->app->make(FactoryInterface::class),
                $this->app->make(SettingsRepositoryInterface::class)
            );
        });
        $this->app->singleton(SessionHandlerFactoryInterface::class, function () {
            return new SessionHandlerFactory(
                $this->app->make(ClientFactoryInterface::class),
                $this->app->make(SettingsRepositoryInterface::class)
            );
        });
        $this->app->singleton(SessionStorageFactoryInterface::class, function () {
            return new SessionStorageFactory(
                $this->app->make(SessionHandlerFactoryInterface::class),
                $this->app->make(SettingsRepositoryInterface::class)
            );
        });
        $this->app->singleton(SessionFactoryInterface::class, function () {
            return new SessionFactory($this->app->make(SessionStorageFactoryInterface::class));
        });

        $this->app->singleton(StartSession::class, function () {
            return new \PixelFederation\RedisSession\Http\Middleware\StartSession(
                $this->app->make(CookieFactory::class),
                $this->app->make(SessionFactoryInterface::class)
            );
        });
    }
}
