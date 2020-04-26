<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 18:03
 */
# models
require_once 'models/LikeModel.php';
require_once 'models/UserModel.php';
require_once 'models/GuestModel.php';

/**
 * обработка запроса
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function processAction($smarty, $dbn, $params)
{
    $voteId = checkVote($dbn, $_POST);
    if ( $voteId != -1) {
        updateVoteById($dbn, $voteId);
    } else {
        $voteId = addNewLike($dbn, $_POST);
    }
    $k['qnt'] = getQuantityByLikeId($dbn, $voteId);


    $data = $_POST;
    $data['like_id'] = (int)$voteId;

    # данные о местоположении пользователя видны при отладке в консоли, но не смог передать их POST'om
    # для запрета двойного нажатия необходимо проверить существование пользователя с
    // - IP адрес
    // - ID поста
    // если такой пользователь уже существует, значит он уже сделал лайк этой страницы

   /* $u = addNewVoteUser($dbn, $data);*/

    echo json_encode($k);
}

/**
 * просмотр данных Like
 *
 * @param object $smarty
 * @param resource $dbn
 * @param array $params
 */
function detailAction($smarty, $dbn, $params)
{
    $infoMsg = !empty($_SESSION['infoMsg']) ? $_SESSION['infoMsg'] : '';
    $activeUser = !empty($_SESSION['userId']) ? $_SESSION['userName'] : 'no user';

    if ($_SESSION['role'] != 'Administrator') {
        $_SESSION['infoMsg'] = "<div class='alert alert-danger'>У Вас нет прав для просмотра</div>";
        header("Location: /user/profile/");
        exit();
    } else {

        $rsData = selGuestsForLike($dbn, $params['id']);

        $smarty->assign('pageTitle', 'Детали Like c ID' . $params['id']);
        $smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
        $smarty->assign('infoMsg', $infoMsg);
        $smarty->assign('activeUser', $activeUser);
        $smarty->assign('role', $_SESSION['role']);
        $smarty->assign('rsData', $rsData);
        loadTemplate($smarty, 'head');
        loadTemplate($smarty, 'guestdetail');
        loadTemplate($smarty, 'footer');

        $_SESSION['infoMsg'] = '';
    }
}
