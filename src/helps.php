<?php

function apiResponse($result){
    $data = [
        'reqId'=>$result['reqId'],
        'code'=>$result['code'],
        'msg'=>$result['msg'],
        'data'=>$result['data'],
    ];
    echo json_encode($data);exit;
}

//cbc加密
function aesEncryptCBC($origData, $key) {
    $blockSize = strlen($key); // AES的块大小
    $origData = pkcs5Padding($origData, $blockSize); // 填充原始数据
    $encrypted = '';
    $iv = openssl_random_pseudo_bytes($blockSize); // 随机生成初始化向量IV
    $encrypted = openssl_encrypt(
        $origData,
        'aes-128-cbc', // 加密算法和模式
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );
    if ($encrypted === false) {
        return ['', 'Encryption failed: ' . openssl_error_string()];
    }
    return [$encrypted, $iv];
}

//cbc解密
function aesDecryptCBC($encrypted, $key) {
    $blockSize = strlen($key); // AES的块大小
    $decrypted = '';
    $ivSize = openssl_cipher_iv_length('aes-128-cbc'); // 获取初始化向量的大小
    $iv = substr($encrypted, 0, $ivSize); // 提取初始化向量
    $encryptedData = substr($encrypted, $ivSize); // 提取加密数据

    $decrypted = openssl_decrypt(
        $encryptedData,
        'aes-128-cbc',
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    if ($decrypted === false) {
        return ['', 'Decryption failed: ' . openssl_error_string()];
    }

    $decrypted = pkcs5UnPadding($decrypted); // 去除填充
    return [$decrypted, ''];
}

function pkcs5Padding($ciphertext, $blockSize) {
    $padding = $blockSize - (strlen($ciphertext) % $blockSize);
    $padText = str_repeat(chr($padding), $padding);
    return $ciphertext . $padText;
}

function pkcs5UnPadding($origData) {
    $length = strlen($origData);
    $unPadding = ord($origData[$length - 1]);
    return substr($origData, 0, $length - $unPadding);
}