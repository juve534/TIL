<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Juve534\LessonQue\LessonQue;

$obj = LessonQue::create('http://elasticmq:9324/queue/lesson');

$obj->sendMessage(
    [
        'name' => 'taro',
        'message' => 'hello',
    ]
);
