<?php


namespace app\controllers;


use app\core\Controller;


class ApiController extends Controller
{
    public function __construct($route) {
        parent::__construct($route);
    }

    public function jsonAction() {
        $answer = $this->model->CheckApiAcl();
        if ($answer === 'Ok') {
            echo $this->model->getJsonData();
        } else {
            echo $answer;
        }
    }

    public function xmlAction() {
        $answer = $this->model->CheckApiAcl();
        if ($answer === 'Ok') {
            echo $this->model->getXmlData();
        } else {
            echo $answer;
        }
    }

    public function json_exampleAction() {
        $data = array('api_key' => $_SESSION['api_key'], 'name'=> $_SESSION['name'], 'email' => $_SESSION['email']);
        session_write_close();
        $this->curl_example('http://test/api/json', $data);
    }

    public function xml_exampleAction() {
        $data = array('api_key' => $_SESSION['api_key'], 'name'=> $_SESSION['name'], 'email' => $_SESSION['email']);
        session_write_close();
        $this->curl_example('http://test/api/xml', $data);
    }

    private function curl_example(string $url, array $data) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function docAction() {
        $vars = ['name' => $_SESSION['name']];
        $this->view->render('Документация API', $vars);
    }
}