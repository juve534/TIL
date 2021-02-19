<?php
require __DIR__ .'/vendor/autoload.php';
use Nesk\Puphpeteer\Puppeteer;

$targetUrl = 'https://www.google.co.jp/';

$puppeteer = new Puppeteer;
$browser = $puppeteer->launch([
    'args' => ['--no-sandbox']
]);
$page = $browser->newPage();
$page->goto($targetUrl);

$page->screenshot(['path' => 'captcha.png']);
$browser->close();
