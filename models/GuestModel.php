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
 * @return int $status
 */
function addNewVoteUser($db, array $data): int
{
    $data = clearData($data);

    $sql = "INSERT INTO users VALUES (null, ?, ?, ?, ?, ? )";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $data['ip'], \PDO::PARAM_STR);
    $stmt->bindValue(2, $data['postal'], \PDO::PARAM_STR);
    $stmt->bindValue(3, $data['city'], \PDO::PARAM_STR);
    $stmt->bindValue(4, $data['country'], \PDO::PARAM_STR);
    $stmt->bindValue(5, $data['like_id'], \PDO::PARAM_INT);

    $stmt->execute();

    if ($db->lastInsertId() > 0) {
        return $db->lastInsertId();
    } else {
        return -1;
    }
}

/**
 * проверяем ставил ли этот пользователь лайк
 *
 * @param resource $db
 * @param array $data
 * @return int $status
 */
function checkGuestVote($db, array $data): int
{
    $sql = "SELECT u.id "
        ."FROM users AS u "
        ."LEFT JOIN votes AS v ON v.client_id = u.id "
        ."WHERE v.site_name = :site_name AND v.page_title = :page_title ";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':site_name' => $data['site_name'],
        ':page_title' => $data['page_title'],
    ]);

    if ($row = $stmt->fetch()) {
        return $row['id'];
    } else {
        return -1;
    }
}
