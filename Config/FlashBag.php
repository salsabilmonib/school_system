<?php

namespace Config;

use Config\Session;

require_once __DIR__ . '/../autoloader.php';

class FlashBag
{
    public static function add(string $type, string $message): void
    {

        $flashbag = Session::get('flashbag') ?? [];
        $flashbag[$type][] = $message;
        Session::set('flashbag', $flashbag);
    }

    public static function get(string $type): ?string
    {
        if (Session::has('flashbag') && isset(Session::get('flashbag')[$type])) {
            $message = Session::get('flashbag')[$type];
            $flashbag = Session::get('flashbag');
            unset($flashbag[$type]);
            Session::set('flashbag', $flashbag);
            return $message;
        }
        return null;
    }

    public static function getAll(): array
    {
        $flashBag = Session::get('flashbag') ?? [];
        Session::set('flashbag', []); // Clear all messages after retrieval
        return $flashBag;
    }

    public static function has(string $type): bool
    {
        return isset(Session::get('flashbag')[$type]);
    }
}
