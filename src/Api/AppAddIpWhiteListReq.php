<?php

namespace Cl\OpenAPISDK\Api;

// 添加ip白名单
class AppAddIpWhiteListReq
{

    public $appUsername;
    public $ip;
    public $proxyType;
}