<?php

namespace App\Bot;

use App\Menu;
use \TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Keyboard
{
    public static function menuAll(): ReplyKeyboardMarkup
    {
        $menus = Menu::all();
        $buttons = array_map(function ($menu) {
            return array(ucfirst($menu->description));
        }, $menus);

        return new ReplyKeyboardMarkup($buttons);
    }
}
