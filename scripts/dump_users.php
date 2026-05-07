<?php
// Dump first 20 users from sqlite via PDO
$db = new PDO('sqlite:C:/laravel1/vohisix/database/database.sqlite');
$stmt = $db->query("SELECT id, username, name, role, password, created_at FROM users LIMIT 20");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($rows)) {
    echo "<no rows>\n";
} else {
    foreach ($rows as $r) {
        echo implode(' | ', [$r['id'] ?? '', $r['username'] ?? '', $r['name'] ?? '', $r['role'] ?? '', substr($r['password'] ?? '',0,20) . '...', $r['created_at'] ?? '']). PHP_EOL;
    }
}
