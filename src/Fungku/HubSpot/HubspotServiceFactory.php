<?php
/**
 * Created by PhpStorm.
 * User: johnf
 * Date: 5/10/2016
 * Time: 9:50 AM
 */

namespace Fungku\HubSpot;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class HubspotServiceFactory
 * @package Fungku\HubSpot
 */
class HubspotServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Zend\InputFilter\InputFilterInterface
     * @throws RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator instanceof ServiceLocatorAwareInterface
            ? $serviceLocator->getServiceLocator()
            : $serviceLocator;

        return HubSpotService::make($this->getHubspotConfig($serviceManager));
    }

    /**
     * @param ServiceLocatorInterface $service
     * @return string
     */
    protected function getHubspotConfig(ServiceLocatorInterface $service)
    {
        if (!$service->has('Config')) {
            throw new RuntimeException('Cannot create WizardNewAccountHubspotListener: config');
        }
        $config = $service->get('Config');

        if (!isset($config['hubspot']['hubspot_api_key'])) {
            throw new RuntimeException('Cannot create WizardNewAccountHubspotListener: missing config api key');
        }

        return $config['hubspot']['hubspot_api_key'];
    }
}
