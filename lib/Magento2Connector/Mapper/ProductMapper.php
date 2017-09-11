<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Mapper;

use Pimcore\Model\Object\AbstractObject;
use Pimcore\Model\Object\Product;
use Swagger\Magento2Client\Model\CatalogDataProductInterface;

/**
 * @class ProductMapper
 * @package  Magento2Connector\Mapper
 */
class ProductMapper implements MapperInterface
{
    /**
     * @param AbstractObject $product
     * @return CatalogDataProductInterface
     */
    public function mapToObject(AbstractObject $product)
    {
        return new CatalogDataProductInterface($this->toArray($product));
    }

    /**
     * @param AbstractObject $product
     * @return array
     */
    public function toArray(AbstractObject $product)
    {
        /**@var Product $product */
        return [
            'sku'               => $product->getSku(),
            'name'              => $product->getName(),
            'attribute_set_id'  => 4,
            'price'             => $product->getPrice(),
            'status'            => 1,
            'visibility'        => 1,
            'weight'            => $product->getWeight(),
            'type'              => 'simple',
            "type_id"           => "simple",
            'custom_attributes' => [
                ['attribute_code' => 'category_ids', 'value' => $this->getCategoryIds($product)],
                ['attribute_code' => 'description', 'value' => $product->getDescription()],
                ['attribute_code' => 'short_description', 'value' => $product->getShortDescription()],
            ]
        ];
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getCategoryIds(Product $product)
    {
        $categories = [];

        foreach ($product->getCategories() as $category) {
            if (!$category->getMagentoId()) {
                continue;
            }

            $categories[] = $category->getMagentoId();
        }

        return $categories;
    }
}
