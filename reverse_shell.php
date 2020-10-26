<?php
$ip = $_GET['ip'];
$port = $_GET['port'];

if(!$ip) {
    $ip = '127.0.0.1';
}
if(!$port) {
    $port = '443';
}

$fp = fopen("Reverse_shell.html", "r");
$str = fread($fp, filesize("Reverse_shell.html"));
$str = str_replace("{ip}", $ip, $str);
$str = str_replace("{port}", $port, $str);


echo $str;
?>
