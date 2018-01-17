<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 *
 */
interface SessionFactoryInterface
{
    /**
     * @return SessionInterface
     */
    public function create();
}
