<?
session_start();

$login = 'admin';
$password = 'admin';

if(isset($_SESSION['admin'])) {
    header('Location: panel.php');
}

if(isset($_POST['done']) && !empty($_POST['login'])) {
    if ($_POST['login'] === $login && $_POST['password'] === $password) {
        $_SESSION['admin'] = $login;
        header('Location: panel.php');
    } else {
        $msg = "Неверный логин или пароль";
    }
}

?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: #f9f9f9;
            font-family: Arial;
            height: 100vh;
        }
        .login {
            width: 400px;
            margin: 150px auto;
            background: #F26F34;
            padding: 24px;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login form {
            width: 70%;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 24px;
        }
        .login form input {
            border: none;
            padding: 12px;
            border-bottom: 3px solid silver;
            outline: none;
            transition: .6s;
        }
        .login form input:active,
        .login form input:focus {
            border-bottom: 3px solid #0D90CB;
        }
        .login form input[type="submit"] {
            border: none;
            background: #0D90CB;
            color: #fff;
            transition: .3s;
            cursor: pointer;
        }
        .login form input[type="submit"]:hover {
            filter: brightness(.9);
        }
        .login p {
            margin-top: 10px;
            background: red;
            color: white;
            padding: 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="login">
        <h2>Вход в админ панель</h2>
        <form method="POST">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            
            <input type="submit" name="done">
        </form>
        <? if (isset($msg) && !empty($msg)) { ?>
            <p><?=$msg?></p>
        <? } ?>
    </div>

</body>
</html>