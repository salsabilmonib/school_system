<?php
namespace Config;

class Helpers
{
    public static function redirect(string $page)
    {
        header("Location: http://localhost:8080/salsabil_school/app/Views/" . $page);
        exit();
    }
}

