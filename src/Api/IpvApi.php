<?php

namespace Cl\OpenAPISDK\Api;


use Cl\OpenAPISDK\Model\IpvConfig;
use GuzzleHttp\Client;
use const Cl\OpenAPISDK\Model\AddIpWhiteListUri;
use const Cl\OpenAPISDK\Model\CreateProxyUserUri;
use const Cl\OpenAPISDK\Model\CreateUserUri;
use const Cl\OpenAPISDK\Model\DelIpWhiteListUri;
use const Cl\OpenAPISDK\Model\DrawByApiUri;
use const Cl\OpenAPISDK\Model\DrawByPwdUri;
use const Cl\OpenAPISDK\Model\Encrypt_AES;
use const Cl\OpenAPISDK\Model\GetAreaUri;
use const Cl\OpenAPISDK\Model\GetInstanceUri;
use const Cl\OpenAPISDK\Model\GetOrderUri;
use const Cl\OpenAPISDK\Model\GetProductAreaListUri;
use const Cl\OpenAPISDK\Model\GetProductStockUri;
use const Cl\OpenAPISDK\Model\InstanceOpenUri;
use const Cl\OpenAPISDK\Model\InstanceReleaseUri;
use const Cl\OpenAPISDK\Model\InstanceRenewUri;
use const Cl\OpenAPISDK\Model\ProxyFlowUseLogUri;
use const Cl\OpenAPISDK\Model\UserAuthUri;
use const Cl\OpenAPISDK\Model\VERSION;


class IpvApi
{
    protected $appId;
    protected $appKey;
    protected $endPont;
    protected $encrypt = Encrypt_AES;
    protected $client;

    protected  $temp = [
        'reqId' => '',
        'code' => 200,
        'msg' => '',
        'data' => '',
    ];

    public function __construct()
    {
        if (func_num_args() == 1 && func_get_arg(0) instanceof IpvConfig) {
            $ipvConfig = func_get_arg(0);

            $this->appId = $ipvConfig->getAppId();
            $this->appKey = $ipvConfig->getAppKey();
            $this->endPont = $ipvConfig->getEndPont();
            $this->encrypt = $ipvConfig->getEncrypt();
            $this->client = new Client();
        }
    }

    //
    public function getProductStock($params)
    {
        if (!$params instanceof AppProductSyncReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(GetProductStockUri, $params);

        $this->resReturn($data);
    }

    // 创建用户
    public function createUser($params)
    {
        if (!$params instanceof AppUserReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(CreateUserUri, $params);

        $this->resReturn($data);
    }

    // 同步实名
    public function userAuth($params)
    {
        if (!$params instanceof AppAuthUserReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(UserAuthUri, $params);

        $this->resReturn($data);
    }

    //  获取订单信息
    public function getOrder($params)
    {
        if (!$params instanceof AppGetOrderReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(GetOrderUri, $params);

        $this->resReturn($data);
    }

    //  获取实列列表
    public function getInstance($params)
    {
        if (!$params instanceof AppGetInstanceReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(GetInstanceUri, $params);

        $this->resReturn($data);
    }

    //  获取地域列表
    public function getArea($params)
    {
        if (!$params instanceof AppGetAreaReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(GetAreaUri, $params);

        $this->resReturn($data);
    }

    //  开通实例
    public function openInstance($params)
    {
        if (!$params instanceof AppInstanceOpenReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(InstanceOpenUri, $params);

        $this->resReturn($data);
    }

    // 续费实例
    public function instanceRenew($params)
    {
        if (!$params instanceof AppInstanceRenewReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(InstanceRenewUri, $params);

        $this->resReturn($data);
    }

    // 释放实例
    public function instanceRelease($params)
    {
        if (!$params instanceof AppInstanceReleaseReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(InstanceReleaseUri, $params);

        $this->resReturn($data);
    }

    // 创建子账号
    public function createAppProxyUser($params)
    {
        if (!$params instanceof CreateAppProxyUserReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(CreateProxyUserUri, $params);

        $this->resReturn($data);
    }

    // 账密提取
    public function drawByPwd($params)
    {
        if (!$params instanceof AppDrawByPwdReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(DrawByPwdUri, $params);

        $this->resReturn($data);
    }

    // 获取动态产品地区列表
    public function getProductAreaList($params)
    {
        if (!$params instanceof AppProductAreaReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(GetProductAreaListUri, $params);

        $this->resReturn($data);
    }

    // 添加ip白名单
    public function addIpWhite($params)
    {
        if (!$params instanceof AppAddIpWhiteListReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(AddIpWhiteListUri, $params);

        $this->resReturn($data);
    }

    // 删除ip白名单
    public function delIpWhite($params)
    {
        if (!$params instanceof AppDelIpWhiteListReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(DelIpWhiteListUri, $params);

        $this->resReturn($data);
    }

    // api提取动态代理
    public function drawByApi($params)
    {
        if (!$params instanceof AppDrawByApiReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(DrawByApiUri, $params);

        $this->resReturn($data);
    }

    // 流量使用记录列表
    public function proxyFlowUseLog($params)
    {
        if (!$params instanceof AppFlowUseLogReq) {
            $temp['code'] = 500;
            $temp['msg'] = 'params error';
            $this->resReturn($temp);
        }

        $data = $this->postData(ProxyFlowUseLogUri, $params);

        $this->resReturn($data);
    }

    public function resReturn($data)
    {

//        if (isset($data['data']) && $data['data']) {
//
//            $encrypted = base64_decode($data['data']);
//
//            if ($encrypted === false) {
//                return [null, 'base64 decode error'];
//            }
//
//            $aesDecData = aesDecryptCbc($encrypted, $this->appKey);
//
//            var_dump('解密后的数据 ===:' . $aesDecData['decrypted']);
//
//        }

        echo json_encode($data);
        exit;
    }

    public function postData($uri, $params)
    {


        $reqData = json_encode($params,JSON_HEX_AMP + JSON_HEX_TAG + JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);

//        $reqData = $params;



        if ($reqData === false) {
            error_log('JSON marshal error: ' . json_last_error_msg());


            $temp['code'] = 500;
            $temp['msg'] = json_last_error_msg();

            return $temp;
        }

        if (empty($this->encrypt)) {
            $this->encrypt = 'AES'; // Assuming 'AES' is the constant for Encrypt_AES
        }


//        var_dump('请求加密前的参数：', $reqData);

        $ens = [];
        if ($this->encrypt === 'AES') {
            $ens = aesEncryptCBC($reqData, $this->appKey);
        }

        $enBase64 = base64_encode($ens['encrypted']);

        // Assuming the existence of a VERSION constant and dto classes
        $aoReq = [
            'version' => VERSION,
            'encrypt' => $this->encrypt,
            'appKey' => $this->appId,
            'params' => $enBase64,
        ];

        try {

            var_dump("request-url ==", $this->endPont . $uri);
            var_dump("request-params ==", json_encode($aoReq));

            $response = $this->client->post($this->endPont . $uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $aoReq,
            ]);
            $statusCode = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true);

            if ($statusCode >= 400 || !isset($data['code']) || $data['code'] != 200) {
                error_log('Error response: ' . json_encode($data));
                throw new \Exception(json_encode($data));
            }

            var_dump("return data ==", json_encode($data));

            return $data;

        } catch (\Exception $e) {
            error_log('Error sending request: ' . $e->getMessage());
            $temp['code'] = 500;
            $temp['msg'] = json_last_error_msg();
            return $temp;
        }
    }


    public function checkEmpty($value)
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }


}