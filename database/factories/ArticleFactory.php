<?php

use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    return [
        'title'=>'Laravel 提供了多种有用的工具来让你更容易的测试使用数据库',
        'type'=>1,
        'content'=>'Laravel 提供了多种有用的工具来让你更容易的测试使用数据库的应用程序。首先，你可以使用 assertDatabaseHas 辅助函数，来断言数据库中是否存在与指定条件互相匹配的数据。举例来说，如果我们想验证 users 数据表中是否存在 email 值为 sally@example.com 的数据，我们可以按照以下的方式来做测试：',
    ];
});
