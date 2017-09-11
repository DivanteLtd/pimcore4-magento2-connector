<?php
/**
 * @category    Magento2Connector
 * @date        09/08/2017 12:08
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Mapper;

use Pimcore\Model\Object\AbstractObject;

/**
 * @class MapperInterface
 * @package  Magento2Connector\Mapper
 */
interface MapperInterface
{
    /**
     * @param AbstractObject $object
     * @return mixed
     */
    public function mapToObject(AbstractObject $object);

    /**
     * @param AbstractObject $object
     * @return array
     */
    public function toArray(AbstractObject $object);
}
