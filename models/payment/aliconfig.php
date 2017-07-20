<?php
/**
 * @author: helei
 * @createTime: 2016-07-15 17:19
 * @description:
 */

// 一下配置均为本人的沙箱环境，贡献出来，大家测试

// helei作者沙箱帐号：
/*
 * 商家账号   naacvg9185@sandbox.com
 * 商户UID   2088102169252684
 * appId     2016073100130857
 */

/*
 * 买家账号    aaqlmq0729@sandbox.com
 * 登录密码    111111
 * 支付密码    111111
 */

return [
    'use_sandbox'               => false,// 是否使用沙盒模式

    'partner'                   => '****',
    'app_id'                    => '***',
    'sign_type'                 => 'RSA',// RSA  RSA2

    // 可以填写文件路径，或者密钥字符串  当前字符串是 rsa2 的支付宝公钥(开放平台获取)
    'ali_public_key'            => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC97EaHDta0OdokPr52H4NGm/1n2VeGB6o0qPf28pED9ssIaQGAFXxWVtmC8JWC3xF2meEhykk8XcPerfk7zQZGYGYFstTJfbqlqkfa5dBS0GVgx7TTpSQpFocrjjZdNfGlqqZCoOO3Xd8Nlwawiethw4hzAP3BYysNGiiRyuyqsQIDAQAB',
    // 可以填写文件路径，或者密钥字符串  我的沙箱模式，rsa与rsa2的私钥相同，为了方便测试
    'rsa_private_key'           => 'MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAJYqmp7/eBqDiH4T8yBG5VMQyzx/p6yUNifgi2tV/8vUUZFxc/EcmtjuVEwTUc/F13YD3oM9/c1uc1gp4/icX9KDifHtYG2Tq2udHPKoH7f17AYPXdF8lFK8V8Ptcp2lqUmMdY66hevwEPDxqCArkQDU/BseGgs2x86i8rDFNCNRAgMBAAECgYEAlIApTFdDRKUS0+uSoTa7Dfwrn/Z1sJsZOzI5bbosLjwXNgfGKoipMSHvRxRL8Xaq7lBBOfSSCxfRBTzX70FlF9Xy1tcTdVkKPQWPIdZ76cyZLWUUFC6PYma+cTS5LlsFKivniipzuDU7xbnzzuLZBDq0UurTsgM6/CrBgel4MIkCQQDosfH1Xa5mse9dT2VQEWMJNLJpayNNA8vwGxrCDbbfJ/OCR7ZuGwdFVA3qk1KdnMRQl/XIrreyjZl69lctDsYbAkEApTS2Gp6Yu3P1g+iKfFV2XQjg7lyRNsNgCjGFoXFK1hH0+92KfcT3cwz7NfAmxlIv4NO8LAla1g9IBb+UlniDAwJBANSJ1ArdanJ6i7uazVr4xpCeBWesaC3sDdZdq28bv7DMeOrCPasMHPQB9kQQFCHKErXaVrDahQcdttZNMwsAt4kCQQCR6WNpUWg+L+XJcmpV9DmNZBkeDb3n61l4x1JqS6C4P7Xrejkmaf/Pqsh5VDk68j39SaUqE70Z0PdgtFutJpU3AkAwLliXRO0CEHGU6DqR4qy5tZ/qrFgbVCoKpSHmtMmt7hYhzJ9XZvNBsHjp1LOwPhNlzFXo5gsDVI9l7JurIV2v',
    'limit_pay'                 => [
        //'balance',// 余额
        //'moneyFund',// 余额宝
        //'debitCardExpress',// 	借记卡快捷
        //'creditCard',//信用卡
        //'creditCardExpress',// 信用卡快捷
        //'creditCardCartoon',//信用卡卡通
        //'credit_group',// 信用支付类型（包含信用卡卡通、信用卡快捷、花呗、花呗分期）
    ],// 用户不可用指定渠道支付当有多个渠道时用“,”分隔

	//异步通知地址
    'notify_url'                => "http://****/alipay/asynnotify",
    //同步跳转
    'return_url'                => "http://****/alipay/pay_asynresult", 
    'return_raw'                => false,// 在处理回调时，是否直接返回原始数据，默认为 true
];