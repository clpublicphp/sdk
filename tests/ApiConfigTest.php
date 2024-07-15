<?php

namespace Clpublic\PhpSdk\Test;


require __DIR__ . "/../vendor/autoload.php";

use Cl\OpenAPISDK\Api\AppAddIpWhiteListReq;
use Cl\OpenAPISDK\Api\AppAuthUserReq;
use Cl\OpenAPISDK\Api\AppDelIpWhiteListReq;
use Cl\OpenAPISDK\Api\AppDrawByApiReq;
use Cl\OpenAPISDK\Api\AppDrawByPwdReq;
use Cl\OpenAPISDK\Api\AppFlowUseLogReq;
use Cl\OpenAPISDK\Api\AppGetAreaReq;
use Cl\OpenAPISDK\Api\AppGetInstanceReq;
use Cl\OpenAPISDK\Api\AppGetOrderReq;
use Cl\OpenAPISDK\Api\AppInstanceOpenReq;
use Cl\OpenAPISDK\Api\AppInstanceReleaseReq;
use Cl\OpenAPISDK\Api\AppInstanceRenewReq;
use Cl\OpenAPISDK\Api\AppProductAreaReq;
use Cl\OpenAPISDK\Api\AppProductSyncReq;
use Cl\OpenAPISDK\Api\AppUserReq;
use Cl\OpenAPISDK\Api\CreateAppProxyUserReq;
use Cl\OpenAPISDK\Api\IpvApi;
use Cl\OpenAPISDK\Model\IpvConfig;
use PHPUnit\Framework\TestCase;

class ApiConfigTest extends TestCase
{
    private $config;

    private $api;

    public function initConfig()
    {
        $this->config = new IpvConfig();

        $this->config->setAppId('AK20240510115408');
        $this->config->setAppKey('t84b334e1ghnw8vg7789ib3y2efd8qzb');
        $this->config->setEndPont('https://sandbox.ipipv.com');

        $this->api = new IpvApi($this->config);
    }

    // 获取产品库存
    public function testConfig()
    {
        $this->initConfig();

        $tmpModel = new AppProductSyncReq();

        $tmpModel->proxyType = [104];

        $this->api->getProductStock($tmpModel);
    }

    //创建和修改主账户
    public function testCreateUser()
    {
        $this->initConfig();

        $tmpModel = new AppUserReq();

        $tmpModel->appUsername = 'test1006';
        $tmpModel->password = '12345678';
        $tmpModel->phone = '13216100665';
        $tmpModel->email = '13216100665@qq.com';
        $tmpModel->authType = 1;
        $tmpModel->authName = 'test company name';
        $tmpModel->no = '3101112';
        $tmpModel->status = 1;

        $this->api->createUser($tmpModel);
    }

    // //同步实名
    public function testUserAuth()
    {
        $this->initConfig();
        $tmpModel = new AppAuthUserReq();

        $tmpModel->username = 'test1019';
        $tmpModel->appUsername = '12345678';
        $tmpModel->authType = 1;
        $tmpModel->authName = '13216100665@qq.com';
        $tmpModel->no = '3101112';
        $tmpModel->vsp = 1;

        $this->api->userAuth($tmpModel);
    }

    // 获取订单信息
    public function testGetOrder()
    {
        $this->initConfig();
        $tmpModel = new AppGetOrderReq();
        $tmpModel->orderNo = 'C20240715163831128305';

        $this->api->getOrder($tmpModel);
    }

    // 获取实列列表
    public function testGetInstance()
    {
        $this->initConfig();
        $tmpModel = new AppGetInstanceReq();
        $tmpModel->Instances = [];

        $this->api->getInstance($tmpModel);
    }

    // 获取实列列表
    public function testGetArea()
    {
        $this->initConfig();
        $tmpModel = new AppGetAreaReq();
        $tmpModel->codes = [];

        $this->api->getArea($tmpModel);
    }

    // 生成临时订单号
    private function generateOrderNum()
    {
        return 'TEST' . date("YmdHis", time());
    }

    // 开通实例 静态编号 C20240715163831128305
    // 开通实例 动态编号 C20240715182508826028     本地订单：TEST20240715182508
    public function testInstanceOpen()
    {
        $this->initConfig();


        $params = [
            [
                'productNo' => 'aws_light_206',  //商品编号（如果存在，后面6项无意义）
                'proxyType' => 101,  //代理类型 101=静态云平台 102=静态国内家庭 103=静态国外家庭 104=动态国外 105=动态国内 201=whatsapp
                'countryCode' => 'CHN',  //国家代码
                'cityCode' => 'CHN013001',  //城市代码
                'supplierCode' => null,  //供应商代码（可为null,随机分配）
                'unit' => 3,  //单位 1=天 2=周(7天) 3=月(自然月) 4=年(自然年365，366) 10=无限制
                'ispType' => 1,  //isp类型 1=单isp 2=双isp
                'count' => 1,  //购买数量 （实例个数）静态必填 默认1 一次最大20
                'duration' => 1, //必要 时长 默认1 为Unit的时长
                'renew' => false,  //是否续费 true 续费 默认false
                'extBandWidth' => 0,  //额外增加带宽 单位Mbps
                'appUsername' => 'test1006',  //渠道商主账号，开通动态代理的时候必填(必须在平台上注册过)
                'flow' => 300,   //动态流量 最大102400MB 动态必填 单位MB
                'useBridge' => 3,  //1=使用桥 2=不使用桥 3=随app设置 默认3
                'cidrBlocks' => [  //静态购买所在网段及数量（产品有的才支持） 2024/06/27新增
                    [
                        'cidr' => '192.168.0.199/24',  //网段 192.168.0.0/24 172.16.0.0/16 10.0.0.0/8
                        'count' => 5
                    ]
                ],
                'projectId' => ''  //购买项目id,保留字段，后续会支持
            ]
        ];

        $paramsDynamic = [
            [
                'productNo' => 'out_dynamic_1',  //商品编号（如果存在，后面6项无意义）
                'proxyType' => 104,  //代理类型 101=静态云平台 102=静态国内家庭 103=静态国外家庭 104=动态国外 105=动态国内 201=whatsapp
                'countryCode' => 'IDN',  //国家代码
                'cityCode' => 'IDN0000JK',  //城市代码
                'supplierCode' => null,  //供应商代码（可为null,随机分配）
                'unit' => 3,  //单位 1=天 2=周(7天) 3=月(自然月) 4=年(自然年365，366) 10=无限制
                'ispType' => 1,  //isp类型 1=单isp 2=双isp
                'count' => 1,  //购买数量 （实例个数）静态必填 默认1 一次最大20
                'duration' => 1, //必要 时长 默认1 为Unit的时长
                'renew' => false,  //是否续费 true 续费 默认false
                'extBandWidth' => 0,  //额外增加带宽 单位Mbps
                'appUsername' => 'test1006',  //渠道商主账号，开通动态代理的时候必填(必须在平台上注册过)
                'flow' => 300,   //动态流量 最大102400MB 动态必填 单位MB
                'useBridge' => 3,  //1=使用桥 2=不使用桥 3=随app设置 默认3
                'cidrBlocks' => [  //静态购买所在网段及数量（产品有的才支持） 2024/06/27新增
                    [
                        'cidr' => '192.168.0.201/24',  //网段 192.168.0.0/24 172.16.0.0/16 10.0.0.0/8
                        'count' => 5
                    ]
                ],
                'projectId' => ''  //购买项目id,保留字段，后续会支持
            ]
        ];

        $tmpModel = new AppInstanceOpenReq();

        $tmpModel->params = $paramsDynamic;
        $tmpModel->appOrderNo = $this->generateOrderNum();

        $this->api->openInstance($tmpModel);
    }

    // 续费实例
    public function testInstanceRenew()
    {
        $this->initConfig();

        $tmpModel = new AppInstanceRenewReq();

        $instanceParams = [
            ['instanceNo'=>'c_gz5krcfjh2sy7d1']
        ];

        $tmpModel->appOrderNo  = 'C20240715163831128305';
        $tmpModel->instances  = $instanceParams;

        $this->api->instanceRenew($tmpModel);

    }

    // 释放实例
    public function testInstanceRelease()
    {
        $this->initConfig();

        $tmpModel = new AppInstanceReleaseReq();

        $instanceParams = ['c_gz5krcfjh2sy7d1'];

        //购买者订单号
        $tmpModel->orderNo  = 'TEST20240715163831';
        $tmpModel->instances  = $instanceParams;

        $this->api->instanceRelease($tmpModel);
    }


    //创建代理商子账号
    public function testCreateAppProxyUser()
    {
        $this->initConfig();
        $tmpModel = new CreateAppProxyUserReq();

        $tmpModel->appUsername = 'test_son_1001';
        $tmpModel->password = '12345678';
        $tmpModel->limitFlow = 200;
        $tmpModel->mainUsername = '';
        $tmpModel->appMainUsername = 'test1006';
        $tmpModel->remark = '策瑜';
        $tmpModel->status = 1;

        $this->api->createAppProxyUser($tmpModel);
    }


    // 账密提取【沙盒环境未真实购买，不能提取到账号】
    public function testDrawByPwd()
    {
        $this->initConfig();

        $tmpModel = new AppDrawByPwdReq();

        $tmpModel->appUsername = 'test_son_1001';
        $tmpModel->addressCode = 'IDN';
        $tmpModel->sessTime = '30';
        $tmpModel->num = 1;
        $tmpModel->proxyType = 104;
        $tmpModel->maxFlowLimit = 10;

        $this->api->drawByPwd($tmpModel);
    }

    // 获取动态产品地区列表
    public function testGetProductAreaList()
    {
        $this->initConfig();

        $tmpModel = new AppProductAreaReq();

        $tmpModel->productNo = 'out_dynamic_1';
        $tmpModel->proxyType = 104;

        $this->api->getProductAreaList($tmpModel);
    }

    // 添加ip白名单 【沙盒返回结果 {"ipWhiteList":null}】
    public function testAddIpWhite()
    {
        $this->initConfig();

        $tmpModel = new AppAddIpWhiteListReq();

        $tmpModel->appUsername = 'test1006';
        $tmpModel->ip = '30.19.10.34';
        $tmpModel->proxyType = 104;

        $this->api->addIpWhite($tmpModel);
    }

    // 删除ip白名单 【沙盒返回结果 {"ipWhiteList":null}】
    public function testDelIpWhite()
    {
        $this->initConfig();

        $tmpModel = new AppDelIpWhiteListReq();

        $tmpModel->appUsername = 'test1006';
        $tmpModel->ip = '30.19.10.34';
        $tmpModel->proxyType = 104;

        $this->api->delIpWhite($tmpModel);
    }

    // Api提取代理请求 【沙盒返回结果 {"reqId":"ac813f0c-d9ef-4472-8739-d29d998a722e","code":500,"msg":"DrawByApi fetch app user packet list empty"}】
    public function testAppDrawByApi()
    {
        $this->initConfig();

        $tmpModel = new AppDrawByApiReq();
        $tmpModel->appUsername = 'test1006';
        $tmpModel->proxyType = 104;
        $tmpModel->num = 1;
        $tmpModel->addressCode = 'IDN';
        $tmpModel->protocol = 'http';
        $tmpModel->returnType = 'json';
        $tmpModel->delimiter = 2;
        $tmpModel->maxFlowLimit = 10;

        $this->api->drawByApi($tmpModel);
    }

    // 流量使用记录列表
    public function testProxyFlowUseLog()
    {
        $this->initConfig();

        $tmpModel = new AppFlowUseLogReq();
        $tmpModel->appUsername = 'test1006';
        $tmpModel->startTime = '2024-01-01 00:00:00';
        $tmpModel->endTime = '2024-07-21 00:00:00';
        $tmpModel->page = 1;
        $tmpModel->pageSize = 10;

        $this->api->proxyFlowUseLog($tmpModel);
    }

}
