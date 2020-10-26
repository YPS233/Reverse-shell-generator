<?php
if(!$_GET['ip']) {
    $ip = '127.0.0.1';
}else{
    $ip = $_GET['ip'];
}
if(!$_GET['port']) {
    $port = '443';
}else{
    $port = $_GET['port'];
}

$ip_pattern = '/^(?:(?:25[0-9]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])\.){3}(?:25[0-9]|2[0-4][0-9]|1[0-9][0-9]|[1-9]?[0-9])$/';
$port_pattern = '/^([0-9]|[1-9]\d{1,3}|[1-5]\d{4}|6[0-4]\d{3}|65[0-4]\d{2}|655[0-2]\d|6553[0-5])$/';
if(preg_match($ip_pattern, $ip) == 0 || preg_match($port_pattern, $port) == 0){
    $current = GetCurUrl();

    echo "<script type='text/javascript'>alert('非法的IP地址或端口');location.href='reverse_shell.php'</script>";

}

$fp = fopen("Reverse_shell.html", "r");
$str = fread($fp, filesize("Reverse_shell.html"));
$str = str_replace("{ip}", $ip, $str);
$str = str_replace("{port}", $port, $str);

function GetCurUrl(){
   $url = 'http://';
   if($_SERVER['SERVER_PORT'] != '80') {
        $url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . ':' . $_SERVER['REQUEST_URI'];
    }else { 
        $url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
    $url = explode('?', $url)[0];
   
    return $url;
}
echo $str;
?>
