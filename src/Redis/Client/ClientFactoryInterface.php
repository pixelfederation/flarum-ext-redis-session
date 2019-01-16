<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Redis\Client;

use Predis\ClientInterface;

interface ClientFactoryInterface
{
    /**
     * @return ClientInterface
     */
    public function create(): ClientInterface;
}
