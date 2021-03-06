<?php

namespace app\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';


	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = []) {
		if (!is_null($vars)) {
            extract($vars);
        }

        $path = 'app/views/'.$this->path.'.php';

        if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'app/views/layouts/'.$this->layout.'.php';
		} else {
            self::errorCode(500);
        }
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = $_SERVER['DOCUMENT_ROOT'].'/app/views/errors/error_page.php';
		if (file_exists($path)) {
            ob_start();
            $path_scripts = 'http://'.$_SERVER['HTTP_HOST'].'/app/views/errors';
            switch ($code)
            {
                case 400: $message = "НЕПРАВИЛЬНЫЙ ЗАПРОС";      $eng_messgae = "BAD REQUEST"; break;
                case 401: $message = "ТРЕБУЕТСЯ АУТЕНТИФИКАЦИЯ"; $eng_messgae = "UNAUTHORIZED"; break;
                case 403: $message = "ДОСТУП ЗАПРЕЩЕН";          $eng_messgae = "FORBIDDEN"; break;
                case 404: $message = "СТРАНИЦА НЕ НАЙДЕНА";      $eng_messgae = "NOT FOUND"; break;
                case 500: $message = "ОШИБКА СЕРВЕРА";           $eng_messgae = "SERVER ERROR"; break;
            }
            $content = ob_get_clean();
			require $path;
		}
		exit;
	}

	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}	