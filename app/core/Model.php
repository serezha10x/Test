<?php

namespace app\core;

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
}