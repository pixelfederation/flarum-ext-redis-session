<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright PIXEL FEDERATION
 * @license:  Internal use only
 */

namespace PixelFederation\RedisSession\Redis\Client;

use Flarum\Settings\SettingsRepositoryInterface;
use PixelFederation\RedisSession\Settings\Settings;
use Predis\Client;
use Predis\Connection\FactoryInterface;

/**
 *
 */
final class ClientFactory implements ClientFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $parametersFactory;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settings;

    /**
     * @param FactoryInterface $parametersFactory
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(FactoryInterface $parametersFactory, SettingsRepositoryInterface $settings)
    {
        $this->parametersFactory = $parametersFactory;
        $this->settings = $settings;
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $connectionParameters = $this->getConnectionParameters();
        $clientParameters = $this->parametersFactory->create($connectionParameters);
        $clientOptions = $this->getClientOptions();

        return new Client($clientParameters, $clientOptions);
    }

    /**
     * @return array
     */
    private function getClientOptions()
    {
        $clientOptions = $this->settings->get(Settings::CLIENT_OPTIONS);
        if ($clientOptions !== null && $clientOptions !== '') {
            return unserialize($clientOptions, [false]);
        }

        return [];
    }

    /**
     * @return array
     */
    private function getConnectionParameters()
    {
        $connectionParameters = $this->settings->get(Settings::CONNECTION_PARAMETERS);
        if ($connectionParameters !== null && $connectionParameters !== '') {
            return unserialize($connectionParameters, [false]);
        }

        $connectionParameters = [
            'host' => $this->settings->get(Settings::HOST),
            'port' => $this->settings->get(Settings::PORT),
            'database' => $this->settings->get(Settings::DB),
        ];

        $password = $this->settings->get(Settings::PASSWORD);
        if ($password !== null && $password !== '') {
            $connectionParameters['password'] = $password;
        }

        return $connectionParameters;
    }
}
