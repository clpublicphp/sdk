<?php

namespace Clpublic\PhpSdk\Api;


use Clpublic\PhpSdk\Model\IpvConfig;
use GuzzleHttp\Client;
use const Clpublic\PhpSdk\Consts\Encrypt_AES;
use const Clpublic\PhpSdk\Consts\GetProductStockUri;
use const Clpublic\PhpSdk\Consts\VERSION;

class IpvApi
{
    protected $appId;
    protected $appKey;
    protected $endPont;
    protected $encrypt = Encrypt_AES;
    protected $client;

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

    public function getProductStock($params)
    {

        list($data, $err) = $this->postData(GetProductStockUri, $params);

        if ($err != null) {
            return [null,$err];
        }
        return [$data, null];
    }

    public function postData($uri, $params)
    {

        $reqData = json_encode($params);
        if ($reqData === false) {
            error_log('JSON marshal error: ' . json_last_error_msg());
            return ['resData' => null, 'err' => json_last_error_msg()];
        }

        if (empty($this->encrypt)) {
            $this->encrypt = 'AES'; // Assuming 'AES' is the constant for Encrypt_AES
        }

        $ens = null;
        if ($this->encrypt === 'AES') {
            $ens = aesEncryptCBC($reqData, $this->appKey);
            if ($ens[0] == '') {
                error_log('AesEncryptCBC err: ' . $ens[1]);
                return ['resData' => null, 'err' => $ens[1]];
            }
        }

        // Assuming the existence of a VERSION constant and dto classes
        $aoReq = [
            'Version' => VERSION,
            'Encrypt' => $this->encrypt,
            'AppKey' => $this->appId,
            'Params' => base64_encode($ens),
        ];

        $ap = json_encode($aoReq);
        if ($ap === false) {
            error_log('JSON marshal error: ' . json_last_error_msg());
            return ['resData' => null, 'err' => json_last_error_msg()];
        }

        try {
            $response = $this->client->post($this->endPont . $uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $ap,
            ]);
            $statusCode = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true);

            if ($statusCode >= 400 || !isset($data['code']) || $data['code'] != 200) {
                error_log('Error response: ' . json_encode($data));
                return [null, 'Error response'];
            }

            $encrypted = base64_decode($data['data']);
            if ($encrypted === false) {
                return [null, 'base64 decode error'];
            }

            return [aesDecryptCbc($encrypted, $this->appKey), null];

        } catch (\Exception $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                error_log('Error sending request: ' . $response->getBody()->getContents());
                return [null, 'Error sending request'];
            } else {
                error_log('Error sending request: ' . $e->getMessage());
                return [null, 'Error sending request'];
            }
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