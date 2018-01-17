<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Settings;

/**
 *
 */
final class Settings
{
    public const HOST = 'pixelfederation-redis-session.host';
    public const PORT = 'pixelfederation-redis-session.port';
    public const DB = 'pixelfederation-redis-session.db';
    public const PASSWORD = 'pixelfederation-redis-session.password';
    public const LOCKING = 'pixelfederation-redis-session.locking';
    public const PREFIX = 'pixelfederation-redis-session.prefix';
    public const TTS = 'pixelfederation-redis-session.ttl';
    public const SPIN_LOCK_WAIT = 'pixelfederation-redis-session.spin_lock_wait';
    public const CONNECTION_PARAMETERS = 'pixelfederation-redis-session.connection_parameters';
    public const CLIENT_OPTIONS = 'pixelfederation-redis-session.client_options';
    public const HANDLER_OPTIONS = 'pixelfederation-redis-session.handler_options';
    public const STORAGE_OPTIONS = 'pixelfederation-redis-session.storage_options';
}
