<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Listener;

use Magento2Connector\Swagger\ApiFactory;
use Pimcore\Model\Object\AbstractObject;
use Pimcore\Model\Object\Category;
use Pimcore\Model\Object\Product;

/**
 * @class ListenerFactory
 * @package  Magento2Connector\Listener
 */
class ListenerFactory
{
    /**
     * @param AbstractObject $abstractObject
     * @return CrudListenerInterface
     */
    public static function getFactory(AbstractObject $abstractObject)
    {
        $apiFactory = new ApiFactory();
        $diContainer = \Pimcore::getDiContainer();
        switch ($abstractObject) {
            case $abstractObject instanceof Product:
                $catalogRepositoryClass = $apiFactory->get('CatalogProductRepositoryV1Api');
                return new ProductCrudListener(
                    $catalogRepositoryClass,
                    $diContainer->get('magento2.event_manager'),
                    $diContainer->get('magento2.product.request.body.builder')
                );
                break;

            case $abstractObject instanceof Category:
                $categoryRepositoryClass = $apiFactory->get('CatalogCategoryRepositoryV1Api');
                return new CategoryCrudListener(
                    $categoryRepositoryClass,
                    $diContainer->get('magento2.event_manager'),
                    $diContainer->get('magento2.category.request.body.builder')
                );
                break;
            default:
                return null;
        }
    }
}

