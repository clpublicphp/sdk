<?php
namespace Clpublic\PhpSdk\Consts;

const VERSION = "v2";

// 获取产品库存
const GetProductStockUri = "/api/open/app/product/query/" . VERSION;
//创建和修改主账户
const    CreateUserUri = "/api/open/app/user/" . VERSION;
//同步实名
const    UserAuthUri = "/api/open/app/userAuth/" . VERSION;
// 获取订单列表
const    GetOrderUri = "/api/open/app/order/" . VERSION;
// 获取实列列表
const    GetInstanceUri = "/api/open/app/instance/" . VERSION;
// 地域列表
const    GetAreaUri = "/api/open/app/area/" . VERSION;
// 开通实例
const    InstanceOpenUri = "/api/open/app/instance/open/" . VERSION;
// 续费实例
const    InstanceRenewUri = "/api/open/app/instance/renew/" . VERSION;
// 释放实例
const    InstanceReleaseUri = "/api/open/app/instance/release/" . VERSION;
//账密提取
const    DrawByPwdUri = "/api/open/app/proxy/draw/pwd/" . VERSION;
//获取代理信息
const    ProxyInfoUri = "/api/open/app/proxy/info/" . VERSION;
//创建和修改代理用户（子账号）
const    CreateProxyUserUri = "/api/open/app/proxy/user/" . VERSION;
// 获取动态代理区域
const    GetProductAreaListUri = "/api/open/app/product/area/" . VERSION;
// 添加ip白名单
const    AddIpWhiteListUri = "/api/open/app/proxy/addIpWhiteList/" . VERSION;
// 删除ip白名单
const    DelIpWhiteListUri = "/api/open/app/proxy/delIpWhiteList/" . VERSION;
//Api提取动态代理
const    DrawByApiUri = "/api/open/app/proxy/draw/api/" . VERSION;
// 流量使用记录列表
const    ProxyFlowUseLogUri = "/api/open/app/proxy/flow/use/log/" . VERSION;
//aes cbc模式
const    Encrypt_AES = "AES";