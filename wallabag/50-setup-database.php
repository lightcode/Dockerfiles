#!/usr/bin/php
<?php

function recursiveRmDir($dir) {
    $iterator = new RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS), \RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($iterator as $filename => $fileInfo) {
        if ($fileInfo->isDir()) {
            rmdir($filename);
        } else {
            unlink($filename);
        }
    }

    rmdir($dir);
}



define('MYSQL_SCHEMA', '/app/install/mysql.sql');

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
    echo "Sorry, this website is experiencing problems.";

    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

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

$default_user = "wallabag";
$default_pass = "wallabag";
$default_email = "";
$salted_password = sha1($default_pass . $default_user . $salt);

$stmt = $mysqli->prepare('INSERT INTO users (id, username, password, name, email) VALUES (1, ?, ?, ?, ?)');
$stmt->bind_param('ssss', $default_user, $salted_password, $default_user, $default_email);
$stmt->execute();
$stmt->close();

$mysqli->close();



// Clean installation

recursiveRmDir("/app/install");

?>
