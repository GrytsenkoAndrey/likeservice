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
# functions
require_once 'library/functions.php';
# controller - action - parameters
$arrCAP = defineCAP();
# check user auth
if (!isset($_SESSION['user_id'])) {
    $arrCAP['controller'] = 'user';
    $arrCAP['action'] = 'login';
}
# page
loadPage($smarty, $dbn, $arrCAP['controller'], $arrCAP['action'], $arrCAP['params']);