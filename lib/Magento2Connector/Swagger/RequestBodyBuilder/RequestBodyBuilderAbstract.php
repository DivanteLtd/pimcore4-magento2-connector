<?php
/**
 * @category    Magento2Connector
 * @date        10/08/2017 09:25
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger\RequestBodyBuilder;

use Magento2Connector\Mapper\MapperInterface;

/**
 * @class RequestBodyBuilderAbstract
 * @package  Magento2Connector\Swagger\RequestBodyBuilder
 */
abstract class RequestBodyBuilderAbstract implements RequestBodyBuilderInterface
{
    /** @var MapperInterface */
    protected $objectMapper;

    /**
     * RequestBodyBuilder constructor.
     * @param MapperInterface $objectMapper
     */
    public function __construct(MapperInterface $objectMapper)
    {
        $this->objectMapper = $objectMapper;
    }
}
