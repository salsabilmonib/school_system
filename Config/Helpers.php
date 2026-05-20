<?php

namespace Config;

class Helpers
{
    public static function redirect(string $page)
    {
        header("Location: " . rtrim(APP_URL, "/") . "/app/Views/" . $page);
        exit();
    }
    public static function debug($value):void
    {
        var_dump($value);
    }
    public static function dd($value): void
    {
        var_dump($value);
        die;
    }
}

