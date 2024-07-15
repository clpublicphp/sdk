<?php

namespace Cl\OpenAPISDK\Api;

//创建或修改代理用户（子账号）
class CreateAppProxyUserReq
{
    public $appUsername;    //渠道商子账号 该渠道商唯一 (不传随机生成) 不支持修改
    public $password;       //密码(不传随机生成)
    public $limitFlow;      //动态流量上限
    public $mainUsername;   //平台主账号  选填 平台主账号和渠道商主账号两个必填一个
    public $appMainUsername;//渠道商主账号 选填 平台主账号和渠道商主账号两个必填一个
    public $remark;         //备注
    public $status;         //状态 1=正常 2=禁用

}