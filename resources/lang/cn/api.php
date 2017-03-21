<?php

return [
    'app_id' => [
        'required' => '缺少app_id参数',
        'size' => 'app_id长度错误，正确为18位字符串',
        'exists' => 'app_id不存在'
    ],
    'app_secret' => [
        'required' => '缺少app_secret参数',
        'size' => 'app_secret必须为32位字符串',
        'exists' => 'app_secret不正确'
    ],
    'access_token' => [
        'required' => '缺少access_token参数',
        'invalid' => 'access_token错误或已失效'
    ],
    'customer_token' => [
        'required' => '缺少参与用户token',
        'alpha_num' => '用户token必须为字符串格式',
        'size' => '用户token必须为32位长度字符串',
    ],
    'activity_token' => [
        'required' => '缺少活动token',
        'exists' => '活动不存在',
    ]

];