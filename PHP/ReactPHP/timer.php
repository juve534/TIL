<?php
/**
 * ReactPHPを使って非同期処理実装
 * @author juve534
 */
require 'vendor/autoload.php';

echo date('Y-m-d H:i:s') . PHP_EOL;
echo 'started.' . PHP_EOL;

$loop = React\EventLoop\Factory::create();
timerFunc($loop);
$loop->run();
echo date('Y-m-d H:i:s') . PHP_EOL;

/**
 * 非同期でタイマー実施用
 *
 * @param  Object  $loop Reactのオブジェクト
 * @return boolean true
 */
function timerFunc($loop)
{
    $emitter = new \Evenement\EventEmitter();

    $loop->addTimer(1, function () use ($emitter) {
        $emitter->emit('Sleep 1');
    });

    $emitter->on('Sleep 1', function () {
        echo 'Sleep 1 started' . PHP_EOL;
    });

    $loop->addTimer(2, function () use ($emitter) {
        $emitter->emit('Sleep 2');
    });

    $emitter->on('Sleep 2', function () {
        echo 'Sleep 2 started' . PHP_EOL;
    });

    $loop->addTimer(3, function () use ($emitter) {
        $emitter->emit('Sleep 3');
    });

    $emitter->on('Sleep 3', function () {
        echo 'Sleep 3 started' . PHP_EOL;
    });

    return true;
}