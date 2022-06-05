<?
require_once '../components/header.php';
require_once '../../db.php';

$category = $db->query("SELECT * FROM `category`");






if(isset($_POST['done']) && !empty($_POST['title'])) {
    $path = 'uploads/';
    $filename = substr(password_hash($_FILES['img']['name'], PASSWORD_DEFAULT), 0, 16).'a.png';
    $pathFile = '../../uploads/'.$filename;
    @copy($_FILES['img']['tmp_name'], $pathFile);
    
    $title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_POST['author'];
    $imgSrc = '/uploads/'.$filename;
    $category_id = $_POST['category_id'];

    $addedResult = $db->query("INSERT INTO `books`(`title`, `text`, `author`, `img`, `category_id`) 
                               VALUES ('$title', '$text', '$author', '$imgSrc', '$category_id')");
    if($addedResult) {
        $msg = "Книга успешно добавлена";
    } else {
        $err = "Ошибка, попробуйте ещё раз";
    }
}



?>

<section>
    <div class="container">
        <div class="added-book">
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

            <? if(isset($err) && !empty($err)) { ?>
                <h3 
                    style="
                        text-align: center; 
                        background: #B22020; 
                        color: #fff; 
                        padding: 8px;
                    "
                >
                    <?=$err?>
                </h3>
            <? } ?>

            <h2 style="margin-top: 40px;">Добавить новую книгу</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Имя книги" required>

                <textarea type="text" name="text" maxlength="130" placeholder="Описание книги" required></textarea>
                <small><span class="hint">0</span> из 130 символов</small>

                <input type="text" name="author" placeholder="Автор книги" required>

                <select name="category_id" required>
                    <option selected disabled>--Выберите категорию --</option>
                    <?
                    foreach ($category as $cat_item) {
                        ?>
                        <option value="<?=$cat_item['id']?>" style="background: <?=$cat_item['color']?>">
                            <?=$cat_item['name']?>
                        </option>
                        <?
                    }
                    ?>
                </select>
                <input type="file" name="img" required>
                <input type="submit" name="done" value="Добавить в реестр">
            </form>
        </div>
    </div>
</section>

<script>
    const added = document.querySelector('.added-book')
    const textareaLength = added.querySelector('textarea');
    const textareaHint = added.querySelector('small');


    textareaLength.addEventListener('input', (e) => {
        if(e.target.value.length !== 130) {
            textareaHint.classList.remove('invalid-text');
            textareaHint.querySelector('.hint').innerText = e.target.value.length
        } else {
            textareaHint.querySelector('.hint').innerText = e.target.value.length
            textareaHint.classList.add('invalid-text');
        }
    })
</script>

<?
require_once '../components/footer.php';
?>