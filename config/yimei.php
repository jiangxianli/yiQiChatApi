<?php

return array(

    /**
     * 网关地址
     */
    'url'              => 'http://sdk4report.eucp.b2m.cn:8080/sdk/SDKService?wsdl',

    /**
     * 序列号,请通过亿美销售人员获取
     */
    'serialNumber'     => '6SDK-EMY-6688-KGWSQ',

    /**
     * 密码,请通过亿美销售人员获取
     */
    'password'         => '724837',

    /**
     * 登录后所持有的SESSION KEY，即可通过login方法时创建
     */
    'sessionKey'       => '161021',

    /**
     * 默认命名空间
     */
    'namespace'        => 'http://sdkhttp.eucp.b2m.cn/',

    /**
     * 往外发送的内容的编码,默认为 GBK
     */
    'outgoingEncoding' => "UTF-8",

    /**
     * 往外发送的内容的编码,默认为 GBK
     */
    'incomingEncoding' => 'UTF-8',
    /**
     * 内容模板
     * [CODE] 将被替换成验证码。
     */

    'contentTpl' => '【麦多】您好，您的验证码是[CODE],请小心保管，不要泄漏。'
);