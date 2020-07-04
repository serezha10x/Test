<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/util/CsrfToken.php';
$csrf = new \app\util\CsrfToken();
if (isset($users) AND count($users) !== 0) {
    echo '
        <form action="../app/handlers/sort_handler.php" method="get">
            <input name="csrf_token" type="hidden" value="'.$csrf->getToken().'"/>
            <br/>
            <p class="text-left font-weight-bold">Выберите метод сортировки:</p>
            <div>
                <div class="form-check">
                    <input checked type="radio" id="nameSort" name="sort" value="name">
                    <label for="nameSort">Сортировка по имени</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="emailSort" name="sort" value="email">
                    <label for="emailSort">Сортировка по email</label>
                </div>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" name="submit">Сортировать</button>
            </div>
        </form>
        <br/>
        <p class="text-center font-weight-bold">Список зарегистрированных пользователей</p>
        <div class="container"></div>
    ';
    foreach ($users as $user) {
        ?>
        <div class="row">
            <div class="col-md-2">
                <img src="../photos/<?=$user['photo']?>"/>
            </div>
            <div class="col-md-2">
                <p><?=$user['name']?></p>
            </div>
            <div class="col-md-2">
                <p><?=$user['email']?></p>
            </div>
        </div>
        <br/>
        <?php
    }
    ?>
    </div>
<?php
} else {
    if (isset($message)) {
        echo "<br/><h4>$message</h4>";
    } else {
        echo '<br/><h4>В базе данных еще нет записей...</h4>';
    }
}
?>