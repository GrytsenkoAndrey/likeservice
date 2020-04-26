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
