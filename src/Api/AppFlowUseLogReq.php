<?php

namespace Cl\OpenAPISDK\Api;

// 流量使用记录
class AppFlowUseLogReq
{
    public $appUsername; //渠道商主账号 必要
    public $startTime; //开始时间 可选 默认7天前 格式 2021-01-01 00:00:00
    public $endTime; //结束时间 可选当天 格式 2021-01-01 00:00:00
    public $page; //页码 可选 默认1
    public $pageSize; //每页数量 可选 默认10 最大100

}