<?php


namespace app\models;


use app\core\Model;
use SimpleXMLElement;

class ApiModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getJsonData() {
        $users = $this->ReadUsers();
        return json_encode($users);
    }

    public function getXmlData() {
        $users = $this->ReadUsers();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><user/>');
        foreach ($users as $user) {
            foreach ($user as $key => $val) {
                $xml->addChild($key, $val);
            }
        }
        return htmlentities($xml->asXML());
    }

    public function CheckApiAcl() {
        $api_key = $_REQUEST['api_key'];
        if ($api_key != null) {
            if ($this->CheckApiKey($api_key)) {
                return 'Ok';
            } else {
                return 'Key is invalid...';
            }
        } else {
            return 'You need authorized firstly before using API';
        }
    }

    public function __destruct() {
        parent::__destruct();
    }
}