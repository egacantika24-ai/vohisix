<?php
$db = new PDO('sqlite:C:/laravel1/vohisix/database/database.sqlite');
foreach ($db->query("SELECT name FROM sqlite_master WHERE type='table'") as $row) {
    echo $row['name'] . PHP_EOL;
}
