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
/*    if ($_POST) {
        $data = json_decode($_POST);
        d($data, 0);
    }
    $data = json_decode($_POST);
    d($data, 0);*/
    $post = json_decode($_POST);
    $data = isset($post['city']) ? $post['city'] : 'no';
    echo json_decode($data);
}