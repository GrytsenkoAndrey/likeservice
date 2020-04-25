<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 17:45
 */
session_start();
# config
require_once 'config/config.php';
require_once 'config/db.php';
# get pdo
$dbn = getConn();
