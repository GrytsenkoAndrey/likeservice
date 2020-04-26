<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 21:28
 */

# работа с таблицей лайков

/**
 * добавление информации в таблицу
 *
 * @param resource $db
 * @param array $data
 * @return int $id
 */
function addNewLike($db, array $data): int
{
    $sql = "INSERT INTO votes(`client_id`, `site_name`, `page_title`, `quantity`) "
        ."VALUES(:client_id, :site_name, :page_title, :quantity) ";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':client_id' => $data['client_id'],
        ':site_name' => $data['site_name'],
        ':page_title' => $data['page_title'],
        ':quantity' => 1,
    ]);
    return $db->lastInsertId();
}

/**
 * получаем количество лайков по ID
 *
 * @param resource $db
 * @param int $id
 * @return int $qnt
 */
function getQuantityByLikeId($db, int $id): int
{
    $sql = "SELECT quantity FROM votes WHERE id = :id ";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id, ]);

    if ($row = $stmt->fetch()) {
        return $row['quantity'];
    } else {
        return 0;
    }
}

/**
 * получаем данные о тех, кто поставил лайк для записи из таблицы Лайк
 * по id записи лайка
 *
 * @param resource $db
 * @param int $id
 * @return array $data
 */
function selGuestsForLike($db, int $id): array
{
    $sql = "SELECT u.id, u.ip, u.post, u.city, u.country "
         ."FROM users AS u "
         ."WHERE like_id = :id ";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id,]);

    if ($rows = $stmt->fetchAll()) {
        return $rows;
    } else {
        return [];
    }
}
