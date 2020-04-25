<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 21:28
 */

# работа с таблицей простых пользователей, которые ставят лайки

/**
 * добавление новой записи о пользователе, поставившем Like
 *
 * @param resource $db
 * @param array $data
 */
function addNewVoteUser($db, array $data)
{
    $sql = "INSERT INTO users(`ip`, `post`, `city`, `country`, `like_id`) "
        ."VALUES(:ip, :post, :city, :country, :like_id)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':ip' => $data['ip'],
        ':post' => $data['post'],
        ':city' => $data['city'],
        ':country' => $data['country'],
        ':like_id' => $data['like_id'],
    ]);

}
