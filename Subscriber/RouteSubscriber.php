<?php

namespace KkPopUp\Subscriber;

use Doctrine\DBAL\Connection;
use Enlight\Event\SubscriberInterface;
use Shopware\Components\Plugin\ConfigReader;


class RouteSubscriber implements SubscriberInterface
{
    private $connection;
    private $pluginDirectory;
    private $config;


    public function __construct($pluginName, $pluginDirectory, ConfigReader $configReader, Connection $connection)
    {
        $this->pluginDirectory = $pluginDirectory;
        $this->config = $configReader->getByPluginName($pluginName);
        $this->connection = $connection;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch',
            'Shopware_CronJob_ReadDB' => 'get_db_data_and_save'
        ];
    }

    public function get_db_data_and_save(\Shopware_Components_Cron_CronJob $job)
    {
        $query = $this->connection->createQueryBuilder();

        $query->select(['id', 'name', 'base_path'])
            ->from('s_core_shops')
            ->andWhere('base_path IS NOT NULL');

        $answer = $query->execute()->fetchAll();

        $file = fopen($this->pluginDirectory . "/results.txt", "a",);

        fwrite($file, json_encode($answer));
        fwrite($file, PHP_EOL);
        fclose($file);
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
