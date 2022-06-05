<?
require_once '../../db.php';

$id = $_GET['id'];
$db->query("DELETE FROM `books` WHERE `books`.`id` = '$id'");
header('Location: /admin/views/delete.php')


?>