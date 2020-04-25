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
function loginAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';

    if ($_POST && isset($_POST['sub'])) {
        # clear info
        $_SESSION['infoMsg'] = '';
        # clear data
        $data = clearData($_POST);

        if (login($dbn, $data)) {
            header("Location: /user/profile/");
            exit();
        } else {
            $_SESSION['infoMsg'] = "<div class='alert alert-danger'>Некорректные данные</div>";
            header("Location: /user/login/");
            exit();
        }
    } else {
        $smarty->assign('pageTitle', 'Авторизация/Регистрация');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'main_login');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

/**
 * регистрация клиентв
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function regAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($_POST) {
        # clear info
        $_SESSION['infoMsg'] = '';
        # clear data
        $data = clearData($_POST);

        if (registration($dbn, $data)) {
            $_SESSION['infoMsg'] = "<div class='alert alert-success'>Привет " . $activeUser . ", Вы успешно прошли регистрацию</div>";
            header("Location: /user/profile/");
            exit();
        } else {
            $_SESSION['infoMsg'] = "<div class='alert alert-danger'>Некорректные данные</div>";
            header("Location: /user/reg/");
            exit();
        }
    } else {
        $smarty->assign('pageTitle', 'Авторизация/Регистрация');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'main_reg');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

/**
 * профиль клиентв
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function profileAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($activeUser == 'no user') {
        $_SESSION['infoMsg'] = "<div class='alert alert-danger'>Авторизуйтесь</div>";
        header("Location: /user/login/");
        exit();
    } else {
        $smarty->assign('pageTitle', 'Профиль клиента');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('role', $_SESSION['role']);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'profile');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

/**
 * профиль клиентв
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function logoutAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    logout();
    header("Location: /user/login/");
    exit();
}