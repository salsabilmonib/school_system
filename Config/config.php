<?php



require(__DIR__ . '/../vendor/autoload.php');


use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(rtrim(__DIR__, '/Config'));
$dotenv->safeLoad();

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('APP_URL', $_ENV['APP_URL']);


// define('DB_HOST', getenv('DB_HOST'));
// define('DB_NAME', getenv('DB_NAME'));
// define('DB_USER', getenv('DB_USER'));
// define('DB_PASS', getenv('DB_PASS'));
// define('APP_URL', getenv('APP_URL'));

// define('DB_HOST', '127.0.0.1');
// define('DB_NAME', 'school');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('APP_URL', 'http://localhost:8080/salsabil_school/');
