<?
require_once '../components/header.php';
require_once '../../db.php';

if(isset($_POST['submit']) && (!empty($_POST['phone']) || !empty($_POST['date']))) {
    $phone = $_POST['phone'];
    $date = $_POST['date'];

    if(!empty($date) && isset($date) && !empty($phone) && isset($phone)) {
        $statistic = $db->query("SELECT * FROM `applications` where `date` LIKE '%$date%' AND `phone` = '$phone'");
    }

    if(!empty($date) && isset($date)) {
        $statistic = $db->query("SELECT * FROM `applications` where `date` LIKE '%$date%'");
    }
    if(!empty($phone) && isset($phone)) {
        $statistic = $db->query("SELECT * FROM `applications` WHERE `phone` = '$phone'");
    }

} else if(isset($_POST['all']) || empty($_POST['phone']) || empty($_POST['date'])) {
    $statistic = $db->query("SELECT * FROM `applications`");
} 
?>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<section>
    <div class="container">
        <div class="d-flex" style="justify-content: space-between">
            <h2>Статистика</h2>
            <form method="POST" class="d-flex">
                <input type="text" class="form-control mask" style="width: 200px; margin-right: 15px" placeholder="+7 (___) ___-__-__" name="phone">
                <input type="date" class="form-control" style="width: 150px; margin-right: 15px" placeholder="Дату" name="date">
                <input type="submit" class="btn btn-primary" value="Поиск" name="submit" style="margin-right: 15px">

                <input type="submit" class="btn btn-info" value="Сбросить" name="all">
            </form>
        </div>
        <table class="table table-light table-striped" style="margin-top: 50px">
        <thead>
            <tr>
                <th scope="col" style="width: 50px">#</th>
                <th scope="col" style="width: 200px">Название книги</th>
                <th colspan="2" scope="col">Категория книги</th>
                <th scope="col" style="width: 200px;">Телефон</th>
                <th scope="col" style="width: 200px;">Дата</th>
                <th scope="col" style="width: 200px;">Удалить?</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($statistic as $value) {?>

                    <tr>
                        <th scope="row"><?=$value['id']?></th>
                        <td><?=$value['titleBook']?></td>
                        <td colspan="2"><?=$value['categoryBook']?></td>
                        <td>
                            <button type="button" class="btn btn-outline-info"><?=$value['phone']?></button>
                        </td>
                        <td><?=$value['date']?></td>
                        <td>
                            <button type="button" class="text-none btn btn-outline-danger">
                                <a class="text-none" href="/admin/views/delete-app.php?id=<?=$value['id']?>">Удалить</a>
                            </button>
                        </td>
                    </tr>
                    <?
                }
            ?>
        </tbody>
        </table>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<?
require_once '../components/footer.php';
?>