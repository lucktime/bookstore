<?php
/**
 * @author: lucky
 * @createTime: 2017年7月19日17:03:38
 * @description: 微信配置文件
 */

return [
    'use_sandbox'       => false,// 是否使用 微信支付仿真测试系统 如果为true，则为模拟状态。金额（amount）需要设置为3.01。
    'app_id'            => '***',  // 公众账号ID
    'mch_id'            => '***',// 商户id
    'md5_key'           => 'e3LvV1ogT5WJRwTFhhYMqYkYBm7gqhtF',// md5 秘钥\
    'app_cert_pem'      => '/cert/apiclient_cert.pem',
    'app_key_pem'       => '/cert/apiclient_key.pem',
    'sign_type'         => 'MD5',// MD5  HMAC-SHA256
    'limit_pay'         => [
        //'no_credit',
    ],// 指定不能使用信用卡支付   不传入，则均可使用
    'fee_type'          => 'CNY',// 货币类型  当前仅支持该字段

    'notify_url'        => 'http://****/wechat/notify',

    'redirect_url'      => 'http://****',// 如果是h5支付，可以设置该值，返回到指定页面

    'return_raw'        => false,// 在处理回调时，是否直接返回原始数据，默认为true
];