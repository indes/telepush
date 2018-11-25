<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Longman\TelegramBot\Telegram;

// Routes
//$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});


$app->get("/", function (Request $request, Response $response, array $args) {
    $response->getBody()->write(":)");
    return $response;
});


$app->get("/send", function (Request $request, Response $response, array $args) {

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
        'text' => (int)getenv('OWNER_ID')
    ]);
    $response->getBody()->write("ok");
    return $response;
});