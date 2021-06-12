<?php

namespace Courses;

spl_autoload_register(function ($classname) {
    $lastslash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastslash);
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/' . $directory . '.php';
    require_once($filename);
});

use Courses\Database\Link;

$conn = Link::getInstance();
$rows = $conn->getCourses();
foreach ($rows as $row) {
    var_dump($row);
}
