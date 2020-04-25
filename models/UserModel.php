<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 25.04.2020
 * Time: 18:11
 */

# работа с таблицей пользователя

/**
 * авторизация
 *
 * @param resource $dbn
 * @param array $data
 * @return bool status
 */
function login($dbn, array $data): bool
{
    $sql = "SELECT c.id, c.email, c.password, g.name AS role "
        ."FROM clients AS c "
        ."LEFT JOIN users_groups AS ug ON ug.user_id = c.id "
        ."LEFT JOIN groups AS g ON g.id = ug.group_id "
        ."WHERE c.email = :email";
    $stmt = $dbn->prepare($sql);
    $stmt->execute([':email' => $data['email']]);
    $dat = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    if (count($dat) >= 1) {
        if (password_verify($data['password'], $dat[0]['password']) == true) {
            $_SESSION['userId'] = $dat[0]['id'];
            $_SESSION['userName'] = $dat[0]['email'];
            $_SESSION['role'] = $dat[0]['role'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * функция регистрации нового пользователя
 *
 * @param resource $db
 * @param array $data
 * @return bool status
 */
function registration($dbn, array $data): bool
{
    # выставляем группу пользователя - обычный (можно было добавить поле в форму регистрации, но не стал)
    $data['groups'] = 2;
    #
    $pdo = $dbn;
    $sql = "SELECT email FROM clients WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $data['regemail']]);
    $dat = $stmt->fetchAll();

    if (count($dat) < 1) {
        // database
        // insert into users
        $sql = "INSERT INTO clients VALUES (null, :email, :password, :regdate, :age)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $data['regemail'],
            ':password' => password_hash($data['regpassword1'], PASSWORD_DEFAULT),
            ':regdate' => date("Y-m-d H-i-s", time()),
            ':age' => $data['age'],
        ]);
        $id = $pdo->lastInsertId();
        // insert into users_groups
        $sql = "INSERT INTO users_groups VALUES (:user_id, :group_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $id,
            ':group_id' => $data['groups'],
        ]);
        $sql = "SELECT u.id, g.name AS role "
            . "FROM clients AS u "
            . "LEFT JOIN users_groups AS ug ON ug.user_id = u.id "
            . "LEFT JOIN groups AS g ON g.id = ug.group_id "
            . "WHERE u.email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $data['regemail']]);
        $group = $stmt->fetch();
        // session
        $_SESSION['userId'] = $id;
        $_SESSION['userName'] = $data['regemail'];
        $_SESSION['role'] = $group['role'];
        return true;
    } else {
        return false;
    }
}

/**
 * выход из системы
 */
function logout()
{
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600);
}
