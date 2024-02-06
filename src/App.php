<?php

namespace App;

use App\Database;
use App\Menu;

class App
{
    private array $config;
    private Database $db;

    public function __construct()
    {
        $this->config = parse_ini_file('config.ini');
        if ($this->config === false) {
            throw new \Exception('Error reading database configuration file');
        }

        $this->db = new Database(
            $this->config['db_driver'],
            $this->config['db_host'],
            $this->config['db_port'],
            $this->config['db_name'],
            $this->config['db_user'],
            $this->config['db_password']
        );
    }

    public function run()
    {
        $conn = $this->db->connect();

        try {
            $bot = new \TelegramBot\Api\Client($this->config['TOKEN']);

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
    }
}
