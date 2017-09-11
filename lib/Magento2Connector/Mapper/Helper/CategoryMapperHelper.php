<?php
/**
 * @category    Magento2Connector
 * @date        11/08/2017 06:01
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Mapper\Helper;

use Pimcore\Model\Object\Category;

/**
 * @class CategoryMapperHelper
 * @package  Magento2Connector
 */
class CategoryMapperHelper
{
    /**
     * @param Category $category
     * @param int $deep
     * @return int
     */
    public function getParentId(Category $category, $deep = 1)
    {
        $level = 1;
        while (null !== $category) {
            if ($deep == $level) {
                $parentCategory = Category::getById($category->getParentId());

                if ($parentCategory instanceof Category) {
                    return $parentCategory->getMagentoId();
                }
            }
            ++$level;
            $category = $category->getParent();
        }

        return 1;
    }
}
