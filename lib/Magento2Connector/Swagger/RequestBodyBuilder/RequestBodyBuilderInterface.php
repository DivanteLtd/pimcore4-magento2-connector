<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 08:38
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger\RequestBodyBuilder;

use Pimcore\Model\Object\AbstractObject;

/**
 * @class RequestBodyBuilderInterface
 * @package  Magento2Connector\Swagger\RequestBodyBuilder
 */
interface RequestBodyBuilderInterface
{
    /**
     * @param AbstractObject $object
     * @return mixed
     */
    public function buildRequestBody(AbstractObject $object);
}
