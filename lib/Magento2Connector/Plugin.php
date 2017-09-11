<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector;

use DI\ContainerBuilder;
use Pimcore\API\Plugin as PluginLib;
use Zend_EventManager_Event;

/**
 * @class Plugin
 * @package  Magento2Connector
 */
class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
{
    /**
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->defineConstants();
        $this->addDependencyInjection();
        $this->registerListeners();
    }

    /**
     * @return void
     */
    protected function defineConstants()
    {
        define('DIVANTE_MAGENTO_2_CONNECTOR_PLUGIN_DIR', __DIR__ . '/../..');
    }

    /**
     * @return void
     */
    protected function addDependencyInjection()
    {
        \Pimcore::getEventManager()->attach("system.di.init", function ($event) {
            /** @var Zend_EventManager_Event $event */
            /** @var ContainerBuilder $builder */
            $builder  = $event->getTarget();
            $filePath = DIVANTE_MAGENTO_2_CONNECTOR_PLUGIN_DIR . '/config/di.php';

            if (file_exists($filePath)) {
                $builder->addDefinitions($filePath);
            }
        });
    }

    /**
     * @return void
     */
    protected function registerListeners()
    {
        \Pimcore::getEventManager()->attach(
            ApiHandler::POST_UPDATE,
            ["Magento2Connector\\ApiHandler", "registerApiHandler"]
        );
        \Pimcore::getEventManager()->attach(
            ApiHandler::POST_DELETE,
            ["Magento2Connector\\ApiHandler", "registerApiHandler"]
        );
    }

    /**
     * @return string
     */
    public static function install()
    {
        Installer::install();

        if (self::isInstalled()) {
            $statusMessage = "Installed";
        } else {
            $statusMessage = "Not installed";
        }

        return $statusMessage;
    }

    /**
     * @return bool
     */
    public static function uninstall()
    {
        return true;
    }

    /**
     * @return bool
     */
    public static function isInstalled()
    {
        if (file_exists(PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector/Magento2ConnectorConfig.php")) {
            return true;
        }

        return false;
    }
}
