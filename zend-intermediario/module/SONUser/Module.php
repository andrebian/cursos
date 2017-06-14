<?php

namespace SONUser;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

/**
 * Class Module
 * @package SONBase
 */
class Module
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'SONUser\Mail\Transport' => function($serviceManager) {
                    $config = $serviceManager->get('config');

                    $transport = new SmtpTransport();
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);

                    return $transport;
                },
                'SONUser\Service\User' => function($serviceManager) {
                    return new Service\User(
                        $serviceManager->get('Doctrine\ORM\EntityManager'),
                        $serviceManager->get('SONUser\Mail\Transport'),
                        $serviceManager->get('View')
                    );
                }
            ],
        ];
    }
}
