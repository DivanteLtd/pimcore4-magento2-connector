<?php
/**
 * @category    Magento2Connector
 * @date        09/08/2017 10:51
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener\Helper;

use Pimcore\Model\Object\AbstractObject;

class ListenerHelper
{
    /**
     * @param AbstractObject $object
     * @return bool
     */
    public static function shouldBeSendToMagento(AbstractObject $object)
    {
         return (bool)$object->getPublished();
    }
}
