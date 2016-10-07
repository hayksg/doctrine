<?php

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

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
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Admin\Model\CategoryTable' => function ($sm) {
                    return new Model\CategoryTable(
                        $sm->get('Doctrine\ORM\EntityManager')
                    );
                }
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                'Admin\Controller\Category' => function ($sm) {
                    return new Controller\CategoryController(
                        $sm->getServiceLocator()->get('Admin\Model\CategoryTable')
                    );
                }
            ],
        ];
    }
}
