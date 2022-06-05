<?
require_once '../../db.php';

$id = $_GET['id'];
$db->query("DELETE FROM `applications` WHERE `id` = '$id'");
header('Location: /admin/views/statistics.php');

?>