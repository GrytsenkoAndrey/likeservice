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
    $sql = "SELECT email, password FROM clients WHERE email = :email";
    $stmt = $dbn->prepare($sql);
    $stmt->execute([':email' => $data['email']]);
    $dat = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    if (count($dat) >= 1) {
        if (password_verify($data['password'], $dat[0]['password']) == true) {
            $_SESSION['userId'] = $dat[0]['id'];
            $_SESSION['userName'] = $dat[0]['email'];
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
    $pdo = $dbn;
    $sql = "SELECT email FROM clients WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $data['email']]);
    $dat = $stmt->fetchAll();

    if (count($dat) < 1) {
        // database
        // insert into users
        $sql = "INSERT INTO clients VALUES (null, :email, :password, :regdate, :age)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $data['email'],
            ':password' => password_hash($data['password1'], PASSWORD_DEFAULT),
            ':regdate' => date("Y-m-d H-i-s", time()),
            ':age' => $data['age'],
        ]);
        $id = $pdo->lastInsertId();
        // session
        $_SESSION['userId'] = $id;
        $_SESSION['userName'] = $data['email'];
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
