<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session\Storage;

use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

/**
 *
 */
interface SessionStorageFactoryInterface
{
    /**
     * @return SessionStorageInterface
     */
    public function create();
}
