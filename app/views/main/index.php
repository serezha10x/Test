<?php
if (!count($users) === 0 OR !$users == null) {
    echo '
        <form action="../app/handlers/sort_handler.php" method="get">
        <p>Выберите метод сортировки:</p>
        <div>
            <input checked type="radio" id="nameSort" name="sort" value="name">
            <label for="nameSort">Сортировка по имени</label>
    
            <input type="radio" id="emailSort" name="sort" value="email">
            <label for="emailSort">Сортировка по email</label>
        </div>
        <div>
            <button type="submit" name="submit">Сортировать</button>
        </div>
        </form>';
} else {
    echo '<br/><h4>В базе данных еще нет записей...</h4>';
}
?>

<?php
    if (isset($users)) {
        foreach ($users as $user) {
            echo
                '<p>' . $user['name'] .'</p>' .
                '<p>' . $user['email'] .'</p>' .
                '<img src="../photos/'. $user['photo'] . '"/>'
            ;
        }
    }
?>