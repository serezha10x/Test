<?php

namespace app\core;

use app\models\UserModel;
use Exception;
use PDO;

abstract class Model {

    protected $pdo;
	protected $username = 'root';
	protected $password = '';
	protected $host = '127.0.0.1';
	protected $dbname = 'Test';

	public function __construct() {
        $this->pdo = $this->connect();
    }

    public function setDB($host, $dbname, $username, $password) {
	    $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->pdo = $this->connect();
    }

    public function connect() {
	    return new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
	}

    public function __destruct() {
        $this->pdo = NULL;
    }

    public function ReadUsers($sort_type = 'name') {
        if ((isset($_SESSION['name']) AND isset($_SESSION['email'])) OR (isset($_REQUEST['name']) AND isset($_REQUEST['email']))) {
            $sql_select_users = 'SELECT * FROM `'.UserModel::TABLE_USER.'` ORDER BY `'.$sort_type.'`';
            $users = $this->pdo->query($sql_select_users)->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
        return NULL;
    }

    public function CheckApiKey(string $api_key) : bool {
        if (isset($_REQUEST['name']) AND isset($_REQUEST['email'])) {
            $sql_select_user_by_email = 'SELECT * FROM `'.UserModel::TABLE_USER.'` WHERE `'.UserModel::EMAIL_FIELD.'` = "'. $_REQUEST['email']. '"';
            $user = $this->pdo->query($sql_select_user_by_email)->fetch(PDO::FETCH_ASSOC);
            if ($user[UserModel::API_KEY_FIELD] === $api_key) {
                return true;
            }
            return false;
        }
        return false;
    }
}