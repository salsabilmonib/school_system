<?php
namespace Config;
use PDO;
require_once 'config.php';

class Database {
    private static $dbConnection = null;
    private static function connect() {
          if (self::$dbConnection !=null) {
               return self::$dbConnection;
          }

          $charset = 'utf8mb4';
          $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . $charset;
          $options = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
          ];

          try {
               return self::$dbConnection = new PDO($dsn, DB_USER, DB_PASS, $options);
          } catch (\PDOException $e) {
               throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }
     }

     public static function fetchOne(string $sql, array $params = []) {
          $stmt = self::connect()->prepare($sql);
          $stmt->execute($params);
          return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     public static function fetchAll(string $sql, array $params = []) {
          $stmt = self::connect()->prepare($sql);
          $stmt->execute($params);
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     
}
?>


