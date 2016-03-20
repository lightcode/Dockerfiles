#!/usr/bin/php
<?php

define('MYSQL_SCHEMA', '/tmp/init-mysql.sql');

$salt     = getenv('WALLABAG_SALT');
$host     = getenv('WALLABAG_HOST') ?: getenv('MYSQL_PORT_3306_TCP_ADDR');
$user     = getenv('WALLABAG_USER');
$passwd   = getenv('WALLABAG_PASSWORD');
$database = getenv('WALLABAG_DATABASE') ?: 'wallabag';



// Configure Wallabag

copy('/app/inc/poche/config.inc.default.php', '/app/inc/poche/config.inc.php');

$config = file_get_contents('/app/inc/poche/config.inc.php');

$config = str_replace("define ('SALT', '');", "define ('SALT', '${salt}');", $config);
$config = str_replace("define ('STORAGE', 'sqlite');", "define ('STORAGE', 'mysql');", $config);
$config = str_replace("define ('STORAGE_SERVER', 'localhost');", "define ('STORAGE_SERVER', '${host}');", $config);
$config = str_replace("define ('STORAGE_DB', 'poche');", "define ('STORAGE_DB', '${database}');", $config);
$config = str_replace("define ('STORAGE_USER', 'poche');", "define ('STORAGE_USER', '${user}');", $config);
$config = str_replace("define ('STORAGE_PASSWORD', 'poche');", "define ('STORAGE_PASSWORD', '${passwd}');", $config);

file_put_contents('/app/inc/poche/config.inc.php', $config);



// Setup database

printf("Connection to mysql with host=%s user=%s database=%s\n", $host, $user, $database);

$mysqli = new mysqli($host, $user, $passwd, $database);

if ($mysqli->connect_errno) {
    printf("[FATAL] Cannot connect to the database: [%d] %s\n", $mysqli->connect_errno, $mysqli->connect_error);
    exit(1);
}

$sql = file_get_contents(MYSQL_SCHEMA);

$lines = explode(';', preg_replace("/[\r\n]/", "", $sql));

foreach ($lines as $line) {
    if (strpos($line, '--') !== 0 && $line) {
        $mysqli->query($line);
    }
}



// Add default user

$row = $mysqli->query("SELECT COUNT(*) FROM `users`")->fetch_row();

if ((int)$row[0] === 0) {
    $default_user = "wallabag";
    $default_pass = "wallabag";
    $default_email = "";
    $salted_password = sha1($default_pass . $default_user . $salt);

    // Add user
    $stmt = $mysqli->prepare('INSERT INTO users (username, password, name, email) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $default_user, $salted_password, $default_user, $default_email);
    if ($stmt->execute()) {
        $user_id = (int)$mysqli->insert_id;
    } else {
        printf("[FATAL] Cannot create user: %s\n", $mysqli->error);
        exit(1);
    }
    $stmt->close();

    // Configure the user profile
    $user_config = [
        'language' => 'en_EN.utf8',
        'pager' => '10',
        'theme' => 'baggy'
    ];

    $stmt = $mysqli->prepare('INSERT INTO users_config (user_id, name, value) VALUES (?, ?, ?)');

    foreach ($user_config as $name => $value) {
        $stmt->bind_param('iss', $user_id, $name, $value);
        if (!$stmt->execute()) {
            printf("[WARN] Cannot add parameter '%s' for user '%s': %s\n", $name, $default_user, $mysqli->error);
        }
    }

    $stmt->close();
}

$mysqli->close();

?>
