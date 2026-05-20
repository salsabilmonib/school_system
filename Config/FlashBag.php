<?php

namespace Config;

use Config\Session;

require_once __DIR__ . '/../autoloader.php';

class FlashBag
{
    const SESSION_NAME = 'flash_bag';
    public static function add(string $type, string $message): void
    {

        $flashBag = Session::get(self::SESSION_NAME) ?? [];
        $flashBag[$type][] = $message;
        Session::set(self::SESSION_NAME, $flashBag);
    }

    public static function get(string $type): ?string
    {
        if (Session::has(self::SESSION_NAME) && isset(Session::get(self::SESSION_NAME)[$type])) {
            $message = Session::get(self::SESSION_NAME)[$type];
            $flashBag = Session::get(self::SESSION_NAME);
            unset($flashBag[$type]);
            Session::set(self::SESSION_NAME, $flashBag);
            return $message;
        }
        return null;
    }

    public static function getAll(): array
    {
        $flashBag = Session::get(self::SESSION_NAME) ?? [];
        Session::set(self::SESSION_NAME, []); // Clear all messages after retrieval
        return $flashBag;
    }

    public static function has(string $type): bool
    {
        return isset(Session::get(self::SESSION_NAME)[$type]);
    }
}
