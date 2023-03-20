<?php

namespace KkPopUp\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\Plugin\ConfigReader;


class RouteSubscriber implements SubscriberInterface
{
    private $pluginDirectory;
    private $config;


    public function __construct($pluginName, $pluginDirectory, ConfigReader $configReader)
    {
        $this->pluginDirectory = $pluginDirectory;

        $this->config = $configReader->getByPluginName($pluginName);
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch'
        ];
    }

    public function onPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');
        $view = $controller->View();

        

        if ($this->config['KkPopUpSlogan']) {
            $view->assign('KkPopUpSlogan', $this->config['KkPopUpSlogan']);
        } else {
            $view->assign('KkPopUpSlogan', "Default slogan for popup, You can change this text in backend panel.");
        }

        if ($controller->Request()->getActionName() === 'index' && $controller->Request()->getControllerName() === 'index') {
            $view->addTemplateDir($this->pluginDirectory . '/Resources/views/');
        }
    }
}
