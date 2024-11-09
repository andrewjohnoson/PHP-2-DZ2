<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
</head>
<body>

<p>Добавить/изменить новость:</p>
<form action="actions/save.php" method="post" enctype="multipart/form-data">
    <?php
        foreach ($cols as $name) {
            echo '<p> Поле ' . $name . '</p>
                   <input type="text" value="" name="'. $name .'"><br>';
        }
    ?>
    <input type="submit" value="Отправить">
</form>

<br>

<p>Удалить новость</p>
<form action="actions/delete.php" method="post" enctype="multipart/form-data">
    <input type="text" value="" name="id"><br>
    <input type="submit" value="Удалить">
</form>

</body>
</html>