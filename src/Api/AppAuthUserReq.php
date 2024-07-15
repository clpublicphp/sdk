<?php

namespace Cl\OpenAPISDK\Api;

// 同步实名请求
class AppAuthUserReq
{
    public $username; //平台主账号 选填 平台主账号和渠道商主账号两个必填一个
    public $appUsername; //渠道商主账号 选填 平台主账号和渠道商主账号两个必填一个
    public  $authType;    //认证类型 1 未实名 2 个人实名 3 企业实名
    public  $authName;    //真实姓名或者企业名
    public  $no;    //实名证件号码或者企业营业执照号码
    public  $vsp;    //vsp
}