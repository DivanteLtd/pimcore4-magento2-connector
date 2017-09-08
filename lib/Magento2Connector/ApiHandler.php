<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector;

use Magento2Connector\Exception\ListenerNotFoundException;
use Magento2Connector\Listener\CrudListenerInterface;
use Magento2Connector\Listener\ListenerFactory;
use Pimcore\Model\Object\AbstractObject;
use Zend_EventManager_Event as GenericEvent;

/**
 * @class ApiHandler
 * @package  Magento2Connector
 */
class ApiHandler
{
    const POST_UPDATE = 'object.postUpdate';
    const POST_DELETE = 'object.postDelete';

    /**
     * @param GenericEvent $event
     */
    public static function registerApiHandler(GenericEvent $event)
    {
        try {
            /** @var \Pimcore\Log\ApplicationLogger $apiLogger */
            $apiLogger = \Pimcore::getDiContainer()->get('magento2.db.api.logger');

            /** @var AbstractObject $target */
            $target = $event->getTarget();

            /** @var CrudListenerInterface $listener */
            $listener = ListenerFactory::getFactory($target);

            if($listener === null) {
                return;
            }

            switch($event->getName()) {
                case self::POST_UPDATE:
                    $listener->onPostUpdate($event);
                    break;
                case self::POST_DELETE:
                    $listener->onPostDelete($event);
                    break;
            }
        }
        catch (ListenerNotFoundException $listenerNotFoundException) {
            $apiLogger->info(sprintf("There is no handler for object type %s.   Register listener for this case.", get_class($target)));
        }
        catch (\RuntimeException $runtimeException) {
            self::throwValidationException($runtimeException);
        }
    }

    /**
     * @param \Exception $runtimeException
     */
    protected static function throwValidationException($runtimeException)
    {
        throw new \RuntimeException(
            $runtimeException->getMessage()
        );
    }
}
