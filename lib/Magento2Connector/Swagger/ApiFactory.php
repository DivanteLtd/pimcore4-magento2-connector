<?php
/**
 * @category    Magento2Connector
 * @date        03/08/2017 08:26
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger;

use Magento2Connector\Exception\ApiClassNotFoundException;

/**
 * @class ApiFactory
 * @package  Magento2Connector\Swagger
 */
class ApiFactory
{
    /** @var string */
    private $apiClass;

    /** @var \DI\Container */
    private $diContainer;

    /**
     * ApiFactory constructor.
     */
    public function __construct()
    {
        $this->diContainer = \Pimcore::getDiContainer();
    }

    /**
     * @param $apiClass
     * @return mixed
     */
    public function get($apiClass)
    {
        $className = "Swagger\\Magento2Client\\Api\\{$apiClass}";

        if (!class_exists($className)) {
            throw new ApiClassNotFoundException(sprintf("Can't find Api class: %s.", $apiClass));
        }

        $this->apiClass = $className;

        return $this->getConfiguredApiClass();
    }

    /**
     * @return mixed
     */
    private function getConfiguredApiClass()
    {
        $this->setAuthorizationHeader();
        $apiClient = $this->diContainer->get('magento2.api.client');

        return new $this->apiClass($apiClient);
    }

    /**
     * @return void
     */
    private function setAuthorizationHeader()
    {
        $config = $this->diContainer->get('magento2.api.client.configuration');
        $config->addDefaultHeader('Authorization', $this->getTokenHeader());
    }

    /**
     * @return string
     */
    private function getTokenHeader()
    {
        $apiToken = $this->diContainer->get('magento2.token.provider');

        return sprintf('Bearer %s', str_replace('"', '', $apiToken->getToken()));
    }
}
