<?php

namespace Cl\OpenAPISDK\Api;

class AppGetOrderReq
{

    public $orderNo;  // 平台订单编号

    public $page;     // 页码  默认1

    public $pageSize; // 每页显示数量  默认10 最大100
}