<?php
namespace Clpublic\PhpSdk\Model;
use Clpublic\PhpSdk\ApiException;
use const Clpublic\PhpSdk\Consts\Encrypt_AES;

class IpvConfig
{

    protected $appId;
    protected $appKey;
    protected $endPont;
    protected $encrypt = Encrypt_AES;

    public function setAppId($appId)
    {
        try {

            if (empty($appId)) {
                throw new ApiException("appid is empty",400);
            }

            $this->appId = $appId;

        }catch (\Exception  $e) {
            throw new ApiException("参数错误 " . $e->getMessage(), 400);
        }

    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setAppKey($appKey)
    {
        try {

            if (empty($appKey)) {
                throw new ApiException("appKey is empty",400);
            }

            $this->appKey = $appKey;

        }catch (\Exception  $e) {
            throw new ApiException("参数错误 " . $e->getMessage(), 400);
        }
    }

    public function getAppKey()
    {
        return $this->appKey;
    }

    public function setEndPont($endPont)
    {
        try {

            if (empty($endPont)) {
                throw new ApiException("endPont is empty",400);
            }

            $this->endPont = $endPont;

        }catch (\Exception  $e) {
            throw new ApiException("参数错误 " . $e->getMessage(), 400);
        }
    }

    public function getEndPont()
    {
        return $this->endPont;
    }

    public function setEncrypt($encrypt)
    {
        $this->encrypt = $encrypt;
    }

    public function getEncrypt()
    {
        return $this->encrypt;
    }

}