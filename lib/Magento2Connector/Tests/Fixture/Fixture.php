<?php

namespace Magento2Connector\Tests\Fixture;

use Mockery\Mock;
use Swagger\Magento2Client\Model\Body18;
use Pimcore\Model\Object\Product;

class Fixture
{
    public function getProduct($created = false)
    {
        /** @var Mock $product */
        $product = \Mockery::mock(Product::class);
        $product->makePartial();

        $product->setId(999);
        $product->sku = 'SKU1234';
        if ($created) {
            $product->isCreated = 'y';
        } else {
            $product->isCreated = null;
        }

        return clone $product;
    }

    public function getBody()
    {
        return new Body18();
    }
}
