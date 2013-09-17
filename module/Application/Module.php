<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
	public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
	{
		$events = $moduleManager->getEventManager()->getSharedManager();
		//$events->attach('bootstrap','bootstrap', array($this, 'initializeView'), 100);
		$events->attach('Application', 'dispatch', function($e) 
			{
				$controller = $e->getTarget();
				$route = $controller->getEvent()->getRouteMatch();
				$controller->getEvent()->getViewModel()->setVariables(array(
					'currentController'=>$route->getParam('controller'),
					'currentAction'=>$route->getParam('action')
				));
			}, 100);
	}

    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	public function getServiceConfig()
	{
        return array(
			'aliases'=>array(
				'Application\Controller\Mentor' => 'mentor',
				'Application\Controller\MentorController' => 'mentors',
			)
		);
	}

	public function getControllerConfig()
	{
        return array(
			'invokables'=>array(
				'Application\Controller\Mentors' => 'Application\Controller\MentorController'
			),
			'aliases'=>array(
			)
		);
        return array(
		);
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
}
