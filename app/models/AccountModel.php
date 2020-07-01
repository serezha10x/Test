<?php

namespace app\models;

use app\core\Model;
use app\core\Router;



class AccountModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function Login(string $name, string $email) : bool {
        // check if there is such user
        $sql_check_email = 'SELECT * FROM `' . UserModel::TABLE_USER . '` WHERE `'.
            UserModel::EMAIL_FIELD . '`= :email AND `'.UserModel::NAME_FIELD.'`= :name';
        $stm = $this->pdo->prepare($sql_check_email);
        $stm->execute(array(':email' => $email, ':name' => $name));
        if ($stm->rowCount() != 0) {
            if(session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            Router::redirect('/');
        }
    }

    public function Register(string $name, string $email, string $photo) : bool {
        // check unique email in db
        $sql_check_email = 'SELECT COUNT(*) as _count FROM `' . UserModel::TABLE_USER . '` WHERE `'.UserModel::EMAIL_FIELD . '`= :email';
        $stm = $this->pdo->prepare($sql_check_email);
        $stm->execute(array(':email' => $email));
        $count_email = $stm->fetchAll();
        if ($count_email[0]['_count'] == 0) {
            // insert a new user
            $sql_regist = 'INSERT INTO `'.UserModel::TABLE_USER.'`(
            `' .UserModel::NAME_FIELD.'`, `'.UserModel::EMAIL_FIELD.'`, `'.UserModel::PHOTO_FIELD.'`) VALUES(:name, :email, :photo)';
            $stm = $this->pdo->prepare($sql_regist);
            $stm->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':photo' => $photo
            ));
            $this->Login($name, $email);
            return true;
        } else {
            return false;
        }
    }


    public function ReadUsers($sort_type = 'name') {
        if (isset($_SESSION['name']) AND isset($_SESSION['email'])) {
            $sql_select_users = 'SELECT * FROM `'.UserModel::TABLE_USER.'` ORDER BY `'.$sort_type.'`';
            $users = $this->pdo->query($sql_select_users)->fetchAll();
            return $users;
        }
        return NULL;
    }


    public function __destruct() {
        parent::__destruct();
    }
}