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
                // tables
                'Admin\Model\CategoryTable' => function ($sm) {
                    return new Model\CategoryTable(
                        $sm->get('Doctrine\ORM\EntityManager')
                    );
                },

                // forms
                'Admin\Form\CategoryForm' => function ($sm) {
                    $form = new Form\CategoryForm();
                    $form->setInputFilter($sm->get('Admin\Form\CategoryFilter'));
                    return $form;
                },

                // filters
                'Admin\Form\CategoryFilter' => function ($sm) {
                    return new Filter\CategoryFilter();
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
                        $sm->getServiceLocator()->get('Admin\Model\CategoryTable'),
                        $sm->getServiceLocator()->get('Admin\Form\CategoryForm')
                    );
                }
            ],
        ];
    }
}
