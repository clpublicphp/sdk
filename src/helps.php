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
    $blockSize = 16; // AES的块大小

//    $origData = pkcs5Padding($origData, $blockSize);
//
//    for ($i=0;$i<strlen($origData);$i++) {
//        echo ord($origData[$i])." ";
//    }


    $iv = substr($key,0,16); // 生成随机初始化向量

    $encryptedData = openssl_encrypt(
        $origData,
        'aes-256-cbc',
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    if ($encryptedData === false) {
        return ['encrypted' => null, 'error' => 'Encryption failed'];
    }

//    echo 'bin2hex -$encryptedData :'.bin2hex($encryptedData).PHP_EOL;
//
//    for ($i=0;$i<strlen($encryptedData);$i++) {
//        echo ord($encryptedData[$i])." ";
//    }

    return ['encrypted' => $encryptedData, 'iv' => $iv];
}

//cbc解密
function aesDecryptCBC($encryptedData, $key) {

    $iv = substr($key,0,16);

    $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    if ($decryptedData === false) {
        return ['decrypted' => null, 'error' => 'Decryption failed'];
    }
    return ['decrypted' => $decryptedData, 'iv' => $iv];
}

function pkcs5Padding($text, $blockSize) {

    $padding = $blockSize - (strlen($text) % $blockSize);

    var_dump('$padding ==== '.$padding);

    $text .= str_repeat(chr($padding), $padding);
    return $text;
}

function pkcs5UnPadding($origData) {
    $unPadding = ord($origData[strlen($origData) - 1]);
    return substr($origData, 0, -$unPadding);
}

function dd(...$vars)
{
    echo '<pre>';

    foreach ($vars as $v) {
        var_dump($v);
    }

    echo '</pre>';

    exit(1);
}
