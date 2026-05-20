<?php

namespace Config;

class Cookie
{

    private static string $path = '/';
    private static string $domain = '';
    private static bool $secure = false; // Set to true if using HTTPS
    private static bool $httponly = false; // Prevents JavaScript access
    private static string $sameSite = 'Lax';

    // Set a standalone cookie
    public static function set(string $key, string $value, int $expiry = 3600,  string $path = '/', string $domain = '', bool $secure = false, bool $httponly = true): bool
    {
        return setcookie(
            $key,
            $value,
            $expiry,
            $path,
            $domain,
            $secure,
            $httponly
        );
    }

    // Get a standalone cookie value
    public static function get(string $key): mixed
    {
        return $_COOKIE[$key] ?? null;
    }

    // Delete a standalone cookie
    public static function delete(string $key,  string $path = '/'): bool
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            // Force browser expiry by setting time to the past
            return setcookie(
                $key,
                $value = '',
                time() - 3600,
                $path,
                self::$domain,
                self::$secure,
                self::$httponly
            );
        }
        return false;
    }


    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }
}
