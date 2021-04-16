<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Juve534\LessonQue\LessonQue;

$obj = LessonQue::create('http://elasticmq:9324/queue/lesson');

while (true) {
    $message = $obj->receiveMessage();
    if (\is_null($message)) {
        sleep(1);
    } else {
        var_dump($message);
        break;
    }
}
