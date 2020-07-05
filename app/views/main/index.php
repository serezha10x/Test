<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/util/CsrfToken.php';
$csrf = new \app\util\CsrfToken();

if (isset($users) AND count($users) !== 0) {
    echo '
        <form action="../app/handlers/sort_handler.php" method="post">
            <input name="csrf_token" type="hidden" value="'.$csrf->getToken().'"/>
            <br/>
            <p class="text-left font-weight-bold">Выберите метод сортировки:</p>
            <div>
                <div class="form-check">
                    <input type="radio" id="nameSort" name="sort" value="name">
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

    $prev_attr = '';
    $next_attr = '';
    if ($current_page == 1) {
        $prev_attr = 'disabled';
    }
    if ($current_page == $count) {
        $next_attr = 'disabled';
    }

    echo '<nav>
        <ul class="pagination">
            <li class="page-item '.$prev_attr.'">
                <a class="page-link" href="http://'.$_SERVER[HTTP_HOST].'?page='.($current_page-1).'">Previous</a>
            </li>';
    for($i = 1; $i <= $count; ++$i) {
        if ($current_page == $i) {
            echo '<li class="page-item active">
                      <a class="page-link" href="#">'.$i.'<span class="sr-only">(current)</span></a>
                  </li>';
        } else {
            echo '<li class="page-item">
                      <a class="page-link" href="'. "http://$_SERVER[HTTP_HOST]?page=$i" .'">'.$i.'</a>
                  </li>';
        }
    }
    echo '<li class="page-item '.$next_attr .'">
                <a class="page-link" href="http://'.$_SERVER[HTTP_HOST].'?page='.($current_page+1).'">Next</a>
            </li>
        </ul>
    </nav>';
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