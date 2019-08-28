<?php
/**
 * Created by PhpStorm.
 * User: johnf
 * Date: 5/10/2016
 * Time: 9:50 AM
 */

namespace Fungku\HubSpot;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HubspotServiceFactory
 * @package Fungku\HubSpot
 */
class HubspotServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return HubSpotService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return HubSpotService::make($this->getHubspotConfig($container));
    }

    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    protected function getHubspotConfig(ContainerInterface $container)
    {
        if (!$container->has('Config')) {
            throw new RuntimeException('Cannot create WizardNewAccountHubspotListener: config');
        }
        $config = $container->get('Config');

        if (!isset($config['hubspot']['hubspot_api_key'])) {
            throw new RuntimeException('Cannot create WizardNewAccountHubspotListener: missing config api key');
        }

        return $config['hubspot']['hubspot_api_key'];
    }
}
