<?php
/**
 * @category    Magento2Connector
 * @date        03/08/2017 10:39
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector;

/**
 * @class Installer
 * @package  Magento2Connector
 */
class Installer
{
    /**
     * @return void
     */
    public static function install()
    {
        self::createConfigFile();
    }

    /**
     * return void
     */
    private static function createConfigFile()
    {
        if (!is_file(PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector/Magento2ConnectorConfig.php")) {
            mkdir(PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector", 0777, true);
            copy(PIMCORE_PLUGINS_PATH . "/Magento2Connector/config/Magento2ConnectorConfigSample.php", PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector/Magento2ConnectorConfig.php");
            copy(PIMCORE_PLUGINS_PATH . "/Magento2Connector/config/.htaccess", PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector/.htaccess");
        }
    }
}
