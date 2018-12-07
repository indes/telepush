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


$app->map(['GET', 'POST'], "/api/msg", function (Request $request, Response $response, array $args) {

    $telegram = new Telegram(getenv('BOT_TOKEN'));
    if (getenv('PROXY')) {
        Longman\TelegramBot\Request::setClient(
            new \GuzzleHttp\Client([
                'base_uri' => 'https://api.telegram.org',
                'proxy' => getenv('PROXY')
            ])
        );
    }

    $parsedBody = $request->getParsedBody();

    $text = $parsedBody["text"] ? $parsedBody["text"] : $request->getQueryParam("text");

    $result = Longman\TelegramBot\Request::sendMessage([
        'chat_id' => (int)getenv('OWNER_ID'),
        'text' => $text
    ]);


    if ($result->isOk()) {
        return $response->withJson(["ok" => true]);
    } else {
        return $response->withJson($result);
    }

});

$app->map(['GET', 'POST'], "/api/photo", function (Request $request, Response $response, array $args) {

    $telegram = new Telegram(getenv('BOT_TOKEN'));
    if (getenv('PROXY')) {
        Longman\TelegramBot\Request::setClient(
            new \GuzzleHttp\Client([
                'base_uri' => 'https://api.telegram.org',
                'proxy' => getenv('PROXY')
            ])
        );
    }

    $parsedBody = $request->getParsedBody();

    $url = $parsedBody["url"] ? $parsedBody["url"] : $request->getQueryParam("url");

    $result = Longman\TelegramBot\Request::sendPhoto([
        'chat_id' => (int)getenv('OWNER_ID'),
        'photo'   => $url
    ]);


    if ($result->isOk()) {
        return $response->withJson(["ok" => true]);
    } else {
        return $response->withJson($result);
    }

});