<?php
return [
    "default"     => 'local', //默认返回存储位置url
    "dirver"      => ['local'], //存储平台 ['local', 'qiniu', 'aliyun']
    "connections" => [
        "local"  => [
            'prefix' => 'uploads/markdown', //本地存储位置，默认uploads
        ],
    ],
];