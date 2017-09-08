<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   Copyright (c) 2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger;

/**
 * @class TokenProviderInterface
 * @package  Magento2Connector\Swagger
 */
interface TokenProviderInterface
{
    /**
     * @return string
     */
    public function getToken();
}
