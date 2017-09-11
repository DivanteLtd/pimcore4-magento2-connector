<?php
/**
 * @category    Magento2Connector
 * @date        03/08/2017 11:43
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Config;

/**
 * @class ConfigService
 * @package  Magento2Connector\Config
 */
class ConfigService
{
    /** @var string */
    public static $configFile = PIMCORE_WEBSITE_PATH . "/var/plugins/Magento2Connector/Magento2ConnectorConfig.php";

    /** @var array */
    private $options = [
        'username',
        'password',
        'host'
    ];

    /** @var \Zend_Config */
    private $config;

    /**
     * ConfigService constructor.
     */
    public function __construct()
    {
        $this->config = $this->getConfig();
    }

    /**
     * @param string $option
     */
    public function get($option)
    {
        return $this->config->magento2connector->{$option};
    }

    /**
     * @return \Zend_Config
     */
    private function getConfig()
    {
        $config = new \Zend_Config(require self::$configFile);
        $this->checkConfig($config);

        return $config;
    }

    /**
     * @param $config
     * @throws \Exception
     */
    private function checkConfig($config)
    {
        foreach ($this->options as $option) {
            if (empty($config->magento2connector->{$option})) {
                throw new \Exception(sprintf("Property %s is not defined, check Your config file", $option));
            }
        }
    }
}
