<?php
/**
 * @category    Magento2Connector
 * @date        14/06/2017 09:25
 * @author      Kamil Wręczycki <kwreczycki@divante.pl>
 * @author      Bartosz Idzikowski <bidzikowski@divante.pl>
 * @copyright   2017 Divante Ltd. (https://divante.co)
 */

namespace Magento2Connector\Swagger;

use Swagger\Magento2Client\Api\IntegrationAdminTokenServiceV1Api;

/**
 * @class TokenProvider
 * @package  Magento2Connector\Swagger
 */
class TokenProvider
{
    /** @var IntegrationAdminTokenServiceV1Api */
    private $tokenServiceV1Api;

    /** @var string */
    private $user;

    /** @var string */
    private $password;

    /**
     * TokenProvider constructor.
     * @param IntegrationAdminTokenServiceV1Api $tokenServiceV1Api
     * @param string $user
     * @param string $password
     */
    public function __construct(IntegrationAdminTokenServiceV1Api $tokenServiceV1Api, $user, $password)
    {
        $this->tokenServiceV1Api = $tokenServiceV1Api;
        $this->user              = $user;
        $this->password          = $password;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->tokenServiceV1Api->integrationAdminTokenServiceV1CreateAdminAccessTokenPost([
            'username' => $this->user,
            'password' => $this->password
        ]);
    }
}
