<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener;

use Magento2Connector\Swagger\RequestBodyBuilder\RequestBodyBuilderInterface;
use Pimcore\Model\Object\AbstractObject;
use Pimcore\Model\Object\Product;
use Swagger\Magento2Client\Api\CatalogProductRepositoryV1Api;
use Swagger\Magento2Client\Model\Body18;
use Zend_EventManager_Event as GenericEvent;
use Zend_EventManager_EventManager as EventManager;
use Pimcore\Log\ApplicationLogger;

/**
 * @class ProductCrudListener
 * @package  Magento2Connector\Listener
 */
class ProductCrudListener extends CrudListenerAbstract
{
    /** @var CatalogProductRepositoryV1Api */
    private $catalogProductRepositoryV1Api;

    /**
     * ProductCrudListener constructor.
     * @param CatalogProductRepositoryV1Api $catalogProductRepositoryV1Api
     * @param EventManager $eventManager
     * @param RequestBodyBuilderInterface $bodyBuilder
     */
    public function __construct(
        CatalogProductRepositoryV1Api $catalogProductRepositoryV1Api,
        EventManager $eventManager,
        RequestBodyBuilderInterface $bodyBuilder
    ) {
        parent::__construct($eventManager, $bodyBuilder);
        $this->catalogProductRepositoryV1Api = $catalogProductRepositoryV1Api;
    }

    /**
     * @param GenericEvent $event
     * @return bool
     */
    public function onPostDelete(GenericEvent $event)
    {
        /** @var Product $product */
        $product = $event->getTarget();
        return $this->catalogProductRepositoryV1Api->catalogProductRepositoryV1DeleteByIdDelete(
            $product->getSku()
        );
    }

    /**
     * @param $isCreated
     * @param AbstractObject $product
     * @param Body18 $productBody
     * @return void
     */
    protected function createOrUpdate($isCreated, AbstractObject $product, $productBody)
    {
        /** @var Product $product */
        if (empty($isCreated)) {
            $product->isCreated = 'y';
            $this->catalogProductRepositoryV1Api->catalogProductRepositoryV1SavePost(
                $productBody
            );
            $this->eventManager->clearListeners('object.postUpdate');
            $product->save();
        } else {
            $this->catalogProductRepositoryV1Api->catalogProductRepositoryV1SavePut(
                $product->getSku(),
                $productBody
            );
        }
    }
}

