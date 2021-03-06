<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session\Storage\Handler;

use SessionHandlerInterface;

interface SessionHandlerFactoryInterface
{
    /**
     * @return SessionHandlerInterface
     */
    public function create(): SessionHandlerInterface;
}
