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
        loadTemplate($smarty, 'main_authreg');
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
        loadTemplate($smarty, 'main_authreg');
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

        if ($_SESSION['role'] == 'Administrator') {
            $rsData = selAllUsers($dbn);
            $userId = '';
        } else {
            $userId = $_SESSION['userId'];
            $rsData = [];
            $rsVotes = selClientVotesData($dbn, $_SESSION['userId']);
        }
        $smarty->assign('pageTitle', 'Профиль клиента');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('role', $_SESSION['role']);
        $smarty->assign('rsData', $rsData);
        $smarty->assign('userId', $userId);
        $smarty->assign('rsVotes', $rsVotes);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'profile');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

/**
 * logout
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

/**
 * редактировать профиль клиентв
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function editAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($_SESSION['role'] != 'Administrator') {
        $_SESSION['infoMsg'] = "<div class='alert alert-danger'>У Вас нет прав для редактироваия</div>";
        header("Location: /user/profile/");
        exit();
    } else {

        if ($_POST) {
            # clear info
            $_SESSION['infoMsg'] = '';
            # clear data
            $data = clearData($_POST);

            if (editUser($dbn, $data)) {
                $_SESSION['infoMsg'] = "<div class='alert alert-success'>Данные отредактированы</div>";
                header("Location: /user/profile/");
                exit();
            } else {
                $_SESSION['infoMsg'] = "<div class='alert alert-danger'>Некорректные данные</div>";
                header("Location: /user/profile/");
                exit();
            }
        } else {

            $rsData = getUserDataById($dbn, $params['id']);

            $smarty->assign('pageTitle', 'Профиль клиента');
            $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
            $smarty->assign('infoMsg', $infoMsg);
            $smarty->assign('activeUser', $activeUser);
            $smarty->assign('role', $_SESSION['role']);
            $smarty->assign('user', $rsData);
            loadTemplate($smarty, 'head');
            loadTemplate($smarty, 'edit_client');
            loadTemplate($smarty, 'footer');

            $_SESSION['infoMsg'] = '';
        }

    }
}

/**
 * тестовая страница для отправки Like
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function testAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($activeUser == 'no user') {
        $_SESSION['infoMsg'] = "<div class='alert alert-danger'>Авторизуйтесь</div>";
        header("Location: /user/login/");
        exit();
    } else {


        $smarty->assign('pageTitle', 'Страница теста Like');
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('role', $_SESSION['role']);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'test');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}

/**
 * просмотр данных клиента
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function dataAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($_SESSION['role'] != 'Administrator') {
        $_SESSION['infoMsg'] = "<div class='alert alert-danger'>У Вас нет прав для просмотра</div>";
        header("Location: /user/profile/");
        exit();
    } else {

        $rsData = selClientVotesData($dbn, $params['id']);

        $smarty->assign('pageTitle', 'Детали Like для клиента ID ' . $params['id']);
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('role', $_SESSION['role']);
        $smarty->assign('rsData', $rsData);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'votedetail');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}
