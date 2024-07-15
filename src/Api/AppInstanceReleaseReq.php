<?php

namespace Cl\OpenAPISDK\Api;

// 释放实例
class AppInstanceReleaseReq
{

    public $orderNo; //购买者订单号(渠道商订单号)

    public $instances = []; //平台实例编号
}