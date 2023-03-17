<?php

use Shopware_Components_Plugin_Bootstrap;

class CrystalcompShopCron extends Shopware_Components_Plugin_Bootstrap
{
    public function install()
    {

        $this->createCronJob(
            'crystalcomp_shop_cron',
            'Crystalcomp Shop Cron',
            [
                'interval' => 21600,
                'interval' => 10,
                'executionTime' => '00:00',
                'plugin' => $this,
                'class' => 'Shopware_Read_DataBase',
                'method' => 'run',
            ]
        );

        return true;
    }
}

class Shopware_Read_DataBase
{
    public function run()
    {
        $cronFile = __DIR__ . '/Cron/CrystalcompShopCron.php';
        exec("php {$cronFile}");
    }
}
