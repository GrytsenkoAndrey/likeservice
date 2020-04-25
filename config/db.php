<?php
/**
* подключение к базе данных
*/

/**
 * @return resource
 */
function getConn()
{
    $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
    $opt = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+03:00'", # +2 winter; +3 summer
    ];
    $pdo = new \PDO($dsn, DB_USER, DB_PASS, $opt);
    return $pdo;
}