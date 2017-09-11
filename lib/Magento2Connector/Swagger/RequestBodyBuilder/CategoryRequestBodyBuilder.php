<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 10:58
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger\RequestBodyBuilder;

use Pimcore\Model\Object\AbstractObject;
use Swagger\Magento2Client\Model\Body30;

/**
 * @class CategoryRequestBodyBuilder
 * @package  Magento2Connector\Swagger\RequestBodyBuilder
 */
class CategoryRequestBodyBuilder extends RequestBodyBuilderAbstract
{
    /**
     * @param AbstractObject $category
     * @return Body30
     */
    public function buildRequestBody(AbstractObject $category)
    {
        $categoryBody = new Body30();

        return $categoryBody->setCategory($this->objectMapper->mapToObject($category));
    }
}
