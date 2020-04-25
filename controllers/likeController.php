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
    //TODO
    // добавить проверку на существование лайка для такой страницы
/*    $arrVote = [
        'client_id' => $_POST['client_id'],
        'site_name' => $_POST['site_name'],
        'page_title' => $_POST['page_title'],
    ];

    $id = addNewLike($dbn, $arrVote);*/

   /*$arrUser = [
        'ip' => $_POST['ip'],
        'post' => $_POST['post'],
        'city' => $_POST['city'],
        'country' => $_POST['country'],
        'like_id' => $id,
    ];
    addNewVoteUser($dbn, $arrUser);*/

    #$k['qnt'] = $id; //getQuantityByLikeId($dbn, $id);
    #echo json_encode($k);

    $arrUser = [
        'ip' => '23.23.23.23',
        'post' => '51927',
        'city' => 'Piter',
        'country' => 'UA',
        'like_id' => 8,
    ];
    addNewVoteUser($dbn, $arrUser);
}