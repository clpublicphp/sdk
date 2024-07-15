<?php

namespace Cl\OpenAPISDK\Api;

class AppInstanceRenewReq
{

    public $appOrderNo; //购买者订单号(渠道商订单号)
    public $instances = []; //实例列表
}