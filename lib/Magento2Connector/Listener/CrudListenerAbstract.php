<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 07:27
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener;

use Magento2Connector\Listener\Helper\ListenerHelper;
use Magento2Connector\Swagger\RequestBodyBuilder\RequestBodyBuilderInterface;
use Pimcore\Model\Object\AbstractObject;
use Swagger\Magento2Client\ApiException;
use Zend_EventManager_Event as GenericEvent;
use Zend_EventManager_EventManager as EventManager;

/**
 * @class CrudListenerAbstract
 * @package  Magento2Connector\Listener
 */
abstract class CrudListenerAbstract implements CrudListenerInterface
{

    /** @var mixed */
    protected $apiClass;

    /** @var EventManager */
    protected $eventManager;

    /** @var RequestBodyBuilderInterface */
    protected $bodyBuilder;

    /**
     * ProductCrudListener constructor.
     * @param EventManager $eventManager
     * @param RequestBodyBuilderInterface $bodyBuilder
     */
    public function __construct(
        EventManager $eventManager,
        RequestBodyBuilderInterface $bodyBuilder
    ) {
        $this->eventManager      = $eventManager;
        $this->bodyBuilder       = $bodyBuilder;
    }

    /**
     * @param GenericEvent $event
     * @return void
     */
    public function onPostUpdate(GenericEvent $event)
    {
        try {
            /** @var AbstractObject $target */
            $target = $event->getTarget();

            if (!ListenerHelper::shouldBeSendToMagento($target)) {
                return;
            }

            $requestBody = $this->bodyBuilder->buildRequestBody($target);
            $isCreated   = $target->isCreated;
            $this->createOrUpdate($isCreated, $target, $requestBody);
        } catch (ApiException $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    /**
     * @param $isCreated
     * @param AbstractObject $target
     * @param mixed $requestBody
     * @return mixed
     */
    abstract protected function createOrUpdate($isCreated, AbstractObject $target, $requestBody);
}
