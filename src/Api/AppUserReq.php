<?php

namespace Cl\OpenAPISDK\Api;

class AppUserReq
{

    //渠道商主账号 该渠道商唯一 不支持修改
    public $appUsername;

    //主账号密码(不传随机生成)
    public $password;

    //主账号手机号
    public $phone;

    //主账号邮箱
    public $email;

    //认证类型 1=未实名 2=个人实名 3=企业实名
    public $authType;

    //主账号实名认证的真实名字或者企业名
    public $authName;

    //主账号实名认证的实名证件号码或者企业营业执照号码
    public $no;

    //vsp
    public $vsp;

    //状态 1=正常 2=禁用
    public $status;

}