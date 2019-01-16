<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Session\Storage\Handler;

use Flarum\Settings\SettingsRepositoryInterface;
use PixelFederation\RedisSession\Redis\Client\ClientFactoryInterface;
use PixelFederation\RedisSession\Settings\Settings;
use Predis\Client;
use RuntimeException;
use SessionHandlerInterface;

final class SessionHandlerFactory implements SessionHandlerFactoryInterface
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @param ClientFactoryInterface $clientFactory
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(ClientFactoryInterface $clientFactory, SettingsRepositoryInterface $settings)
    {
        $this->clientFactory = $clientFactory;
        $this->settings = $settings;
    }

    /**
     * @inheritdoc
     * @throws \RuntimeException
     */
    public function create(): SessionHandlerInterface
    {
        $client = $this->createClient();
        $handlerOptions = $this->getHandlerOptions();
        $prefix = $this->settings->get(Settings::PREFIX);
        $locking = $this->settings->get(Settings::LOCKING);
        $spinLockWait = $this->settings->get(Settings::SPIN_LOCK_WAIT);

        return new RedisSessionHandler($client, $handlerOptions, $prefix, $locking, $spinLockWait);
    }

    /**
     * @return Client
     * @throws \RuntimeException
     */
    private function createClient(): Client
    {
        $client = $this->clientFactory->create();
        if (!$client instanceof Client) {
            throw new RuntimeException('Wrong Client');
        }

        return $client;
    }

    /**
     * @return array
     */
    private function getHandlerOptions(): array
    {
        $handlerOptions = $this->settings->get(Settings::HANDLER_OPTIONS);
        if ($handlerOptions !== null && $handlerOptions !== '') {
            return unserialize($handlerOptions, [false]);
        }

        $ttl = $this->settings->get(Settings::TTS);
        if ($ttl !== null && $ttl !== '') {
            return ['gc_maxlifetime' => (int) $ttl];
        }

        return [];
    }
}
