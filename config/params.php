<?php

return [
    'adminEmail' => 'admin@example.com',
    'host' =>'http://localhost:8899',
    /**
    *微信公众号支付
    */
   'wechatpub' => [
        'use_sandbox'       => true,// 是否使用 微信支付仿真测试系统
        'app_id'            => '****',  // 公众账号ID
        'mch_id'            => '***',// 商户id
        'md5_key'           => '***',// md5 秘钥\
        'app_secret'        => '***',//
        'app_cert_pem'      => '/cert/apiclient_cert.pem', //用于退款操作
        'app_key_pem'       => '/cert/apiclient_key.pem',
        'sign_type'         => 'MD5',// MD5  HMAC-SHA256
        'limit_pay'         => [
            //'no_credit',
        ],// 指定不能使用信用卡支付   不传入，则均可使用
        'fee_type'          => 'CNY',// 货币类型  当前仅支持该字段

        'notify_url'        => 'http://***/wechat/notify',

        'redirect_url'      => 'http://***',// 如果是h5支付，可以设置该值，返回到指定页面。公众号->开发->接口权限->网页授权网页授权获取用户基本信息

        'return_raw'        => false,// 在处理回调时，是否直接返回原始数据，默认为true
  ],
];
