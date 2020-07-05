<?php


namespace app\models;


use app\core\Model;

class MainModel extends Model
{
    public $offset = 0;
    public $limit  = 5;
    public $sort_default = 'name';

    public function __construct() {
        parent::__construct();
        if (isset($_GET['page'])) {
            $this->offset = $_GET['page'] * $this->limit - $this->limit;
        }
    }

    public function getCountPage(): int {
        return ceil($this->getCount() / $this->limit);
    }

    public function getCurrentPage(): int {
        return ($this->offset / $this->limit) + 1;
    }
}