<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Longman\TelegramBot\Telegram;


$app->get("/", function (Request $request, Response $response, array $args) {
    $response->getBody()->write("<h1>:)</h1>");
    return $response;
});


$app->get("/ping", function (Request $request, Response $response, array $args) {

    $telegram = new Telegram(getenv('BOT_TOKEN'));
    if (getenv('PROXY')) {
        Longman\TelegramBot\Request::setClient(
            new \GuzzleHttp\Client([
                'base_uri' => 'https://api.telegram.org',
                'proxy' => getenv('PROXY')
            ])
        );
    }

    $result = Longman\TelegramBot\Request::sendMessage([
        'chat_id' => (int)getenv('OWNER_ID'),
        'text' => "ping"
    ]);
    $response->getBody()->write("ping");
    return $response;
});

$app->get("/api/send", function (Request $request, Response $response, array $args) {

    $telegram = new Telegram(getenv('BOT_TOKEN'));
    if (getenv('PROXY')) {
        Longman\TelegramBot\Request::setClient(
            new \GuzzleHttp\Client([
                'base_uri' => 'https://api.telegram.org',
                'proxy' => getenv('PROXY')
            ])
        );
    }

    $result = Longman\TelegramBot\Request::sendMessage([
        'chat_id' => (int)getenv('OWNER_ID'),
        'text' => $request->getQueryParam("msg")
    ]);
    $response->getBody()->write("ok");
    return $response;
});