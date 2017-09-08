<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener;

use Zend_EventManager_Event as GenericEvent;

/**
 * @class CrudListenerInterface
 * @package  Magento2Connector\Listener
 */
interface CrudListenerInterface
{
    /**
     * @param GenericEvent $event
     * @return mixed
     */
    public function onPostUpdate(GenericEvent $event);

    /**
     * @param GenericEvent $event
     * @return mixed
     */
    public function onPostDelete(GenericEvent $event);
}
