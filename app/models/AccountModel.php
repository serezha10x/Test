<?php

namespace app\models;

use app\core\Model;
use PDO;


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
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['api_key'] = $row['api_key'];
            return true;
        } else {
            return false;
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
            $api_hash = password_hash(microtime(), PASSWORD_DEFAULT);
            $sql_regist = 'INSERT INTO `'.UserModel::TABLE_USER.'`(
            `'  .UserModel::NAME_FIELD.'`, `'.UserModel::EMAIL_FIELD.'`, `'.UserModel::PHOTO_FIELD.'`, `'
                .UserModel::API_KEY_FIELD . '`) VALUES(:name, :email, :photo, :api_hash);';
            $stm = $this->pdo->prepare($sql_regist);
            $stm->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':photo' => $photo,
                ':api_hash' => $api_hash
            ));
            $this->Login($name, $email);
            return true;
        } else {
            return false;
        }
    }


    public function __destruct() {
        parent::__destruct();
    }
}