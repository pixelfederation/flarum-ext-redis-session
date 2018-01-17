<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session;

use PixelFederation\RedisSession\Session\Storage\SessionStorageFactoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 *
 */
final class SessionFactory implements SessionFactoryInterface
{
    /**
     * @var SessionStorageFactoryInterface
     */
    private $storageFactory;

    /**
     * @param SessionStorageFactoryInterface $storageFactory
     */
    public function __construct(SessionStorageFactoryInterface $storageFactory)
    {
        $this->storageFactory = $storageFactory;
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $storage = $this->storageFactory->create();

        return new Session($storage);
    }
}
