<?php

require 'vendor/autoload.php';

$config = parse_ini_file('config.ini');
if ($config === false) {
    throw new Exception('Error reading database configuration file');
}

try {
    $bot = new \TelegramBot\Api\Client($config['TOKEN']);

    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        array(array('one', 'two', 'three'))
    );

    $bot->command('start', function ($message) use ($bot, $keyboard) {
        $bot->sendMessage(
            chatId: $message->getChat()->getId(),
            text: 'Hello! Choose menu:',
            replyMarkup: $keyboard
        );
    });

    $bot->on(function (\TelegramBot\Api\Types\Update $update) use ($bot, $keyboard) {
        $message = $update->getMessage();
        $id = $message->getChat()->getId();
        $bot->sendMessage(
            chatId: $id,
            text: 'Please choose menu:',
            replyMarkup: $keyboard
        );
    }, function () {
        return true;
    });

    $bot->run();
} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}
