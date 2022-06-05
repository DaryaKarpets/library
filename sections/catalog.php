<section class="catalog">
    <div class="container">
        <div class="catalog__body">
            <div class="catalog-title">
                <span>Популярные книги</span>
            </div>
            <div class="list-items">                
                <?
                $booksDB = $db->query("SELECT `category`.`name`, `category`.`color`, `books`.`title`, `books`.`text`, `books`.`author`, `books`.`img`, `books`.`category_id` FROM  `books` INNER JOIN  `category` ON `books`.`category_id` = `category`.`id` LIMIT 6");

                foreach ($booksDB as $book) {
                ?>
                    <div class="item">
                        <div class="item__wrapper">
                            <div class="item__content">
                                <img src="<?=$book['img']?>">
                                <div class="item__text">
                                    <div class="item__text-header">
                                        <?=$book['title']?>
                                    </div>
                                    <div class="item__text-text">
                                        <?=$book['text']?>
                                    </div>
                                    <div class="item__text-author">Автор: <?=$book['author']?></div>
                                    <a data-fancybox data-src="#booking-dialog" href="javascript:;" class="item__text-btn">Забронировать</a>
                                </div>
                            </div>
                            <div class="item__footer">
                                <span style="background: <?=$book['color']?>"></span>
                                <p><?=$book['name']?></p>
                            </div>
                        </div>
                    </div>
                <? } ?>
      
            </div>
        </div>
    </div>
</section>
