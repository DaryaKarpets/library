<?
require_once '../components/header.php';
require_once '../../db.php';

if(isset($_POST['done'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_POST['author'];


    $res = $db->query("UPDATE `books` SET `title` = '$title', `text` = '$text', `author` = '$author' WHERE `books`.`id` = '$id'");
    if($res) {
        $msg = "Изменена книга '".$title."' - [id: ".$id."]";
    }
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section>
    <div class="container">
        <div class="edit-book">
        <? if(isset($msg) && !empty($msg)) { ?>
                <h3 
                    style="
                        text-align: center; 
                        background: #20B26B; 
                        color: #fff; 
                        padding: 8px;
                    "
                >
                    <?=$msg?>
                </h3>
            <? } ?>
           <div class="item-list">
           <?
            
                $booksDB = $db->query("SELECT `books`.`id`, `category`.`name`, `category`.`color`, `books`.`title`, `books`.`text`, `books`.`author`, `books`.`img`, `books`.`category_id` FROM  `books` INNER JOIN  `category` ON `books`.`category_id` = `category`.`id`");

                foreach ($booksDB as $book) {
                    ?>
                    <div class="item">
                        <div class="item__wrapper">
                            <div class="item__content">
                                <img src="<?=$book['img']?>">
                                <div class="item__text">
                                    <div class="item__text-header">
                                        <b><?=$book['title']?></b>
                                    </div>
                                    <div class="item__text-text">
                                        <?=$book['text']?>
                                    </div>
                                    <div class="item__text-author">
                                        <i>Автор: <?=$book['author']?></i>
                                    </div>
                                </div>
                            </div>
                            <div class="item__footer">
                                <span style="background: <?=$book['color']?>">
                                    <?=$book['name']?>
                                </span>
                            </div>
                            <a class="btn-edit" data-fancybox data-src="#book-edit<?=$book['id']?>" href="javascript:;">Редактировать</a>
                        </div>
                    </div>

                    <div style="display: none;" class="book-edit-dialog" id="book-edit<?=$book['id']?>">
                        <div class="modal-form">
                            <h3>Редактирование</h3>
                            <form method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                                <input type="hidden" name="id" value="<?=$book['id']?>">
                                <label>
                                    <span>Название книги</span>
                                    <input type="text" name="title" placeholder="Название книги" value="<?=$book['title']?>">
                                </label>

                                <label>
                                    <span>Описание</span>
                                    <textarea type="text" name="text" rows="4" maxlength="130" placeholder="Описание книги"><?=$book['text']?></textarea>
                                    <small>Максимум 130 символов</small>
                                </label>

                                <label>
                                    <span>Автор</span>
                                    <input type="text" name="author" placeholder="Автор книги" value="<?=$book['author']?>">
                                </label>

                                <input type="submit" name="done" value="Сохранить">
                            </form>
                        </div>
                    </div>

            <? } ?>
           </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?
require_once '../components/footer.php';
?>