<?php

namespace Cl\OpenAPISDK\Api;

//账密提取
class AppDrawByPwdReq
{
    public $appUsername; //必要（渠道商子账号名）
    public $addressCode; //地址代码 可以传 areaCode countryCode stateCode cityCode 四种之一
    public $sessTime;  //有效时间 1-120分钟 默认5分钟
    public $num;  //数量 默认1
    public $proxyType;  //代理类型 104=动态国外 105=动态国内
    public $maxFlowLimit; //子账号最大流量限制 可选 大于0的时候生效

}