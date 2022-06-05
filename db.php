<?
// Подключение к БД
try {
    $db = new PDO('mysql:host=localhost;dbname=library', 'root', '');
} catch (PDOExeption $e) {
    print($e->getMessage());
    die();
}

?>