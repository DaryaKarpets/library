<?
require_once '../components/header.php';
require_once '../../db.php';
?>

<section>
    <div class="container">
        <div class="book-delete">
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
                            <a href="handler.php?id=<?=$book['id']?>" class="btn-delete">Удалить</a>
                        </div>
                    </div>
            <? } ?>
            </div>
        </div>
    </div>
</section>

<?
require_once '../components/footer.php';
?>