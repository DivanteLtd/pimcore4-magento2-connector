<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 10:51
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger\RequestBodyBuilder;

use Pimcore\Model\Object\AbstractObject;
use Swagger\Magento2Client\Model\Body18;

/**
 * @class ProductRequestBodyBuilder
 * @package  Magento2Connector\Swagger\RequestBodyBuilder
 */
class ProductRequestBodyBuilder extends RequestBodyBuilderAbstract
{
    /**
     * @param AbstractObject $product
     * @return Body18
     */
    public function buildRequestBody(AbstractObject $product)
    {
        $productBody = new Body18();

        return $productBody->setProduct($this->objectMapper->mapToObject($product));
    }
}
