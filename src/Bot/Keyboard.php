<?php

namespace App\Bot;

use App\Model\Menu;
use \TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Keyboard
{
    /**
     * Returns reply keyboard with buttons created using data from Menu model
     *
     * @return ReplyKeyboardMarkup
     */
    public static function menuAll(): ReplyKeyboardMarkup
    {
        $menus = Menu::all();
        $buttons = array_map(function ($menu) {
            return array(ucfirst($menu->description));
        }, $menus);

        return new ReplyKeyboardMarkup($buttons);
    }
}
