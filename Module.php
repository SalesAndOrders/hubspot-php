<?php
/**
 * Created by PhpStorm.
 * User: johnf
 * Date: 5/10/2016
 * Time: 9:36 AM
 */

namespace Fungku\HubSpot;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Class Module
 * @package Fungku\HubSpot
 */
class Module implements ServiceProviderInterface, ConfigProviderInterface
{
    /**
     * @return array|mixed|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }

    /**
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
