<?php

namespace Cl\OpenAPISDK\Api;

// Api提取代理请求
class AppDrawByApiReq
{

    public $appUsername; //渠道商主账号 必要
    public $proxyType; //代理类型 必要 104=动态国外 105=动态国内
    public $num; //提取ip数量 可选 默认1
    public $addressCode;//地址代码 可选  取值 areaCode countryCode stateCode cityCode 四种之一
    public $protocol; //协议 可选 默认socks5  取值 socks5 http 之一
    public $returnType; //数据格式 可选 默认txt  取值 txt json 之一
    public $delimiter; //分隔符 可选 只有数据格式是txt的时候生效 默认1 (1=\r\n 2=/br 3=\r 4=\n 5=\t)
    public $maxFlowLimit; //最大流量限制 可选 大于0的时候生效
}