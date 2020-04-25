<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 18:03
 */
# models
require_once 'models/UserModel.php';

/**
 * страница авторизации/регистрации
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function indexAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['user_id']) ? $_SESSION['user_name'] : 'no user';

    $smarty->assign('pageTitle', 'Авторизация/Регистрация');
    $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
    $smarty->assign('infoMsg', $infoMsg);
    $smarty->assign('activeUser', $activeUser);
    loadTemplate($smarty, 'head');
    loadTemplate($smarty, 'main_authreg');
    loadTemplate($smarty, 'footer');
}