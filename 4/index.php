<?php

$host = '127.0.0.1';
$db = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

/**
 * form an assoc array of users
 * @param $arr
 * @return array
 */
function formUsersArray($arr)
{
    $data = [];
    foreach ($arr as $item) {
        $data[$item['id']] = $item['name'];
    }
    return $data;
}

/**
 * get users from DB, using PDO
 * @param $user_ids
 * @param $pdo
 * @return array
 */
function load_users_data($user_ids, $pdo)
{
    $user_ids = explode(',', $user_ids);
    $in = str_repeat('?,', count($user_ids) - 1) . '?';
    $sql = "SELECT `id`, `name` FROM `users` WHERE `id` IN ($in)";
    $stm = $pdo->prepare($sql);
    $stm->execute($user_ids);
    $res = $stm->fetchall(PDO::FETCH_ASSOC);
    return formUsersArray($res);
}

/**
 * @param $data
 */
function render($data){
    $html = '';
    $html .= '<ul>';
    foreach ($data as $user_id => $name) {
        $html .= "<li><a href=\"/show_user.php?id=$user_id\">$name</a></li>";
    }
    $html .= '</ul>';
    echo $html;
}

$data = load_users_data($_GET['user_ids'], $pdo);
render($data);



/**
 *
 * В цикле создавать подключение к БД - неправильно. Вынес отдельно и передаю как параметр.
 * В запросе используются необработанные данные. Все, что приходит от пользователя, надо обрабатывать для защиты от
 * sql-иньекций. В моем случае я использую PDO, в котором все переданные переменные выполняются
 * через подготовленные выражения.
 * Настройки подключения к БД правильно хранить в отдельном месте.
 * Также можно сделать проверку на существование GET параметра user_ids.
 * В функции render намешан html и php. Это не хорошая практика.
 * По хорошему данные передаются в представление и там выводятся, например с использованием шаблонизатора.
 *
 */
