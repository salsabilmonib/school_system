<?php

namespace Config;

class Session
{
     private static bool $isStarted = false;
     public static function start()
     {
          if (self::$isStarted == true) {
               return;
          }

          if (session_status() === PHP_SESSION_NONE) {
               session_start();
               self::$isStarted = true;
          }
     }

     public static function set(string $key, mixed $value): void
     {
          self::start();
          $_SESSION[$key] = $value;
     }



     public static function has(string $key): bool
     {
          self::start();
          return isset($_SESSION[$key]);
     }

     public static function get(string $key)
     {
          self::start();
          return $_SESSION[$key] ?? null;
     }
     public static function delete(string $key)
     {
          self::start();
          unset($_SESSION[$key]);
     }

     public static function destroy()
     {
          if (self::$isStarted == false) {
               return;
          }


          if (ini_get("session.use_cookies")) {
               Cookie::delete(session_name());
          }
          session_destroy();
          self::$isStarted = false;
     }
}
