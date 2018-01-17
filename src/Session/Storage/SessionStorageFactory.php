<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session\Storage;

use Flarum\Settings\SettingsRepositoryInterface;
use PixelFederation\RedisSession\Session\Storage\Handler\SessionHandlerFactoryInterface;
use PixelFederation\RedisSession\Settings\Settings;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

/**
 *
 */
final class SessionStorageFactory implements SessionStorageFactoryInterface
{
    /**
     * @var SessionHandlerFactoryInterface
     */
    private $handlerFactory;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @param SessionHandlerFactoryInterface $handlerFactory
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SessionHandlerFactoryInterface $handlerFactory, SettingsRepositoryInterface $settings)
    {
        $this->handlerFactory = $handlerFactory;
        $this->settings = $settings;
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $handler = $this->handlerFactory->create();
        $storageOptions = $this->getStorageOptions();


        return new NativeSessionStorage($storageOptions, $handler);
    }

    /**
     * @return array
     */
    private function getStorageOptions()
    {
        $storageOptions = $this->settings->get(Settings::STORAGE_OPTIONS);
        if ($storageOptions !== null && $storageOptions !== '') {
            return unserialize($storageOptions, [false]);
        }

        return [];
    }
}
