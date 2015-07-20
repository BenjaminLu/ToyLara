<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/18
 * Time: 上午 11:03
 */

use App\AppLoader;

define('APP_DIR', dirname(__DIR__) . '/app/');
define('VIEW_DIR', APP_DIR . 'views/');
define('CACHE_DIR', APP_DIR . 'cache/views/');
define('DEBUG_MODE', true);

//DB
define('DB_HOST', 'localhost');
define('DB_NAME', 'pdo');
define('DB_USER', 'root');
define('DB_PASSWORD', 'howard123');
define('DB_ENCODING', 'utf8');
define('DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME);
$dsn = DSN;
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => true
);

if (version_compare(PHP_VERSION, '5.3.6', '<')) {
    if (defined('PDO::MYSQL_ATTR_INIT_COMMAND')) {
        $options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES ' . DB_ENCODING;
    }
} else {
    $dsn .= ';charset=' . DB_ENCODING;
}
$pdo = new \PDO($dsn, DB_USER, DB_PASSWORD, $options);

if (version_compare(PHP_VERSION, '5.3.6', '<') && !defined('PDO::MYSQL_ATTR_INIT_COMMAND')) {
    $sql = 'SET NAMES ' . DB_ENCODING;
    $pdo->exec($sql);
}

AppLoader::initialize();
DB::setPDO($pdo);