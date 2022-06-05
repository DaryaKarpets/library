<?php
require_once 'db.php';

// Получаем данные от фронта
$data = json_decode(file_get_contents('php://input'), true);

$phone = $data['phone'];
$titleBook = $data['titleBook'];
$categoryBook = $data['categoryBook'];
$date = date('Y-m-d H:m');

use PHPMailer\PHPMailer\PHPMailer;
require_once 'phpmailer/PHPMailer.php';

if(empty($titleBook)) {
    $message = '<h2>Поступило письмо с просьбой связаться, номер телефона: ' . $phone . "</h2>";
} else {
    $message = '<h2>Поступило письмо с бронью, номер телефона: ' . $phone . "</h2>";
    $message.= '<h2>Название книги: ' . $titleBook . "</h2>";
    $message.= '<h2>Категория книги: ' . $categoryBook . "</h2>";

    $db->query("INSERT INTO `applications`(`phone`, `titleBook`, `categoryBook`, `date`) VALUES ('$phone', '$titleBook', '$categoryBook', '$date')");
}

// // Создаем письмо
$mail = new PHPMailer(true);
$mail->setFrom('booking@library-family.com'); // от кого (email и имя)
$mail->addAddress('test@test.com');

// // Тема письма
$mail->Subject = "Бронирование книги";
$mail->CharSet = "utf-8";

// // html текст письма
$mail->msgHTML($message);

// // Отправляем
$mail->send();

?>