<?php

namespace Courses\Database;

use mysql_xdevapi\Exception;

class Config {
    private $data;
    private static $instance;

    private function __construct() {
        $json = file_get_contents(__DIR__ . "/../../config/app.json");
        $this->data = json_decode($json, true);
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function getData($key) {
        if(!isset($this->data[$key])) {
            throw new Exception("Data not found.");
        }
        return $this->data[$key];
    }
}


