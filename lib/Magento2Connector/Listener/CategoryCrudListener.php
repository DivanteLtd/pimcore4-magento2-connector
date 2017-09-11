<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener;

use Magento2Connector\Swagger\RequestBodyBuilder\RequestBodyBuilderInterface;
use Pimcore\Model\Object\AbstractObject;
use Pimcore\Model\Object\Category;
use Swagger\Magento2Client\Api\CatalogCategoryRepositoryV1Api;
use Swagger\Magento2Client\Model\Body30;
use Zend_EventManager_Event as GenericEvent;
use Zend_EventManager_EventManager as EventManager;

/**
 * @class CategoryCrudListener
 * @package  Magento2Connector\Listener
 */
class CategoryCrudListener extends CrudListenerAbstract
{
    /** @var CatalogCategoryRepositoryV1Api */
    private $categoryRepositoryClass;

    /**
     * ProductCrudListener constructor.
     * @param CatalogCategoryRepositoryV1Api $categoryRepositoryClass
     * @param EventManager $eventManager
     * @param RequestBodyBuilderInterface $bodyBuilder
     */
    public function __construct(
        CatalogCategoryRepositoryV1Api $categoryRepositoryClass,
        EventManager $eventManager,
        RequestBodyBuilderInterface $bodyBuilder
    ) {
        parent::__construct($eventManager, $bodyBuilder);
        $this->categoryRepositoryClass = $categoryRepositoryClass;
    }

    /**
     * @param GenericEvent $event
     * @return bool
     */
    public function onPostDelete(GenericEvent $event)
    {
        /** @var Category $category */
        $category = $event->getTarget();
        return $this->categoryRepositoryClass->catalogCategoryRepositoryV1DeleteByIdentifierDelete(
            $category->getMagentoId()
        );
    }

    /**
     * @param $isCreated
     * @param AbstractObject $category
     * @param Body30 $categoryBody
     * @return void
     */
    protected function createOrUpdate($isCreated, AbstractObject $category, $categoryBody)
    {
        /** @var Category $category */
        if (empty($category->getMagentoId())) {
            $response = $this->categoryRepositoryClass->catalogCategoryRepositoryV1SavePost(
                $categoryBody
            );
            $category->setMagentoId($response->getId());

            $this->eventManager->clearListeners('object.postUpdate');
            $category->save();
        } else {
            $this->categoryRepositoryClass->catalogCategoryRepositoryV1SavePut(
                $category->getMagentoId(),
                $categoryBody
            );
        }
    }
}
