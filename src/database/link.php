<?php

namespace Courses\Database;
use \PDO;

class Link {
    private $_data;
    private static $dbConnect;
    private static $db;

    private function __construct() {
        $this->_data = Config::getInstance()->getData("db");
        self::$db = new PDO('mysql:host='.$this->_data["host"].';dbname='.$this->_data["schema"],
            $this->_data['user'],$this->_data['password']);
        self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance() {
        if(self::$dbConnect == null) {
            self::$dbConnect = new Link();
        }
        return self::$dbConnect;
    }

    public static function getCourses() {
        return self::$db->query('SELECT * FROM course');
    }

    public static function getCourse($id) {
        if(is_numeric($id)) {
            $query = "SELECT * FROM course WHERE id=$id";
            return self::$db->query($query);
        } else {
            throw new \Exception('Argument is not of type int.');
        }
    }


}