<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 10:23
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Mapper;

use Magento2Connector\Mapper\Helper\CategoryMapperHelper;
use Pimcore\Model\Object\AbstractObject;
use Pimcore\Model\Object\Category;
use Swagger\Magento2Client\Model\CatalogDataCategoryInterface;

/**
 * @class ProductMapper
 * @package  Magento2Connector\Mapper
 */
class CategoryMapper implements MapperInterface
{
    /** @var CategoryMapperHelper */
    private $categoryHelper;

    /**
     * CategoryMapper constructor.
     */
    public function __construct()
    {
        $this->categoryHelper = new CategoryMapperHelper();
    }

    /**
     * @param AbstractObject $category
     * @return CatalogDataCategoryInterface
     */
    public function mapToObject(AbstractObject $category)
    {
        return new CatalogDataCategoryInterface($this->toArray($category));
    }

    /**
     * @param AbstractObject $category
     * @return array
     */
    public function toArray(AbstractObject $category)
    {
        /** @var Category $category */
        return [
            'name'      => $category->getName(),
            "parent_id" => $this->categoryHelper->getParentId($category),
            "is_active" => true,
            "position"  => 0,
            "level"     => 0,
        ];
    }
}
