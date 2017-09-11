<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Tests;

use Magento2Connector\Listener\ProductCrudListener;
use Magento2Connector\Swagger\RequestBodyBuilder;
use Magento2Connector\Tests\Fixture\Fixture;
use MigrationTool\Helper\MockeryTestCase;
use Mockery\Mock;
use Pimcore\Log\ApplicationLogger;
use Swagger\Magento2Client\Api\CatalogProductRepositoryV1Api;

/**
 * Class ProductCrudListenerTest
 * @package Magento2Connector\Tests
 */
class ProductCrudListenerTest extends MockeryTestCase
{
    /** @test */
    public function it_should_send_delete_request()
    {
        $event = \Mockery::mock(\Zend_EventManager_Event::class);
        $event->shouldReceive('getTarget')->once()->andReturn($this->fixture->getProduct(true));
        $this->productCatalogRepository->shouldReceive('catalogProductRepositoryV1DeleteByIdDelete')
            ->with('SKU1234')
            ->once();

        $this->productListener->onPostDelete($event);
    }

    /** @test */
    public function it_should_send_post_request()
    {
        $requestBody = $this->fixture->getBody();
        $this->requestBodyBuilder->shouldReceive('buildProductBody')->andReturn($requestBody);
        $this->productCatalogRepository->shouldReceive('catalogProductRepositoryV1SavePost')->with($requestBody);
        $this->eventManager->shouldReceive('clearListeners')->with('object.postUpdate');

        $event = \Mockery::mock(\Zend_EventManager_Event::class);
        $product = $this->fixture->getProduct();
        $product->shouldReceive('save');

        $event->shouldReceive('getTarget')->once()->andReturn($product);

        $this->productListener->onPostUpdate($event);
    }

    /** @test */
    public function it_should_send_put_request()
    {
        $requestBody = $this->fixture->getBody();
        $this->requestBodyBuilder->shouldReceive('buildProductBody')->andReturn($requestBody);
        $this->productCatalogRepository->shouldReceive('catalogProductRepositoryV1SavePut')->withArgs(['SKU1234', $requestBody]);
        $this->eventManager->shouldReceive('clearListeners')->with('object.postUpdate');

        $event = \Mockery::mock(\Zend_EventManager_Event::class);
        $product = $this->fixture->getProduct(true);
        $product->shouldReceive('save');

        $event->shouldReceive('getTarget')->once()->andReturn($product);

        $this->productListener->onPostUpdate($event);
    }

    public function setUp()
    {
        $this->productCatalogRepository = \Mockery::mock(CatalogProductRepositoryV1Api::class);
        $this->eventManager = \Mockery::mock(\Zend_EventManager_EventManager::class);
        $this->applicationLogger = \Mockery::mock(ApplicationLogger::class);
        $this->requestBodyBuilder = \Mockery::mock(RequestBodyBuilder::class);

        $this->fixture = new Fixture();

        $this->productListener = new ProductCrudListener(
            $this->productCatalogRepository,
            $this->eventManager,
            $this->applicationLogger,
            $this->requestBodyBuilder
        );
    }

    /** @var Fixture */
    private $fixture;
    /** @var ApplicationLogger $applicationLogger */
    private $applicationLogger;
    /** @var Mock $requestBodyBuilder */
    private $requestBodyBuilder;
    /** @var Mock $eventManager */
    private $eventManager;
    /** @var Mock $productCatalogRepository */
    private $productCatalogRepository;
    /** @var ProductCrudListener $productListener */
    private $productListener;
}
