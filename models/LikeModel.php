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
 */
function addNewLike($db, array $data)
{
    $sql = "INSERT INTO votes(`client_id`, `site_name`, `page_title`, `quantity`) "
        ."VALUES(:client_id, :site_name, :page_title, :quantity) ";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':client_id' => $data['client_id'],
        ':site_name' => $data['site_name'],
        ':page_title' => $data['page_title'],
        ':quantity' => $data['quantity'],
    ]);
}
