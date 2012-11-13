<?php

namespace SpeckSearch;

use Zend\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        $config = array();
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
        );
        foreach($configFiles as $configFile) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include $configFile);
        }
        return $config;
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'speck_search_service' => function ($sm) {
                    $service = new Service\Search();
                    $config = $sm->get('Config');
                    $options = isset($config['specksearch']) ? $config['specksearch'] : array();
                    $moduleOptions = \Zend\Stdlib\ArrayUtils::merge($options, include __DIR__ . '/config/module.options.php');
                    $service->setModuleOptions($moduleOptions);
                    return $service;
                },
            ),
        );
    }
}
