<?php
require 'Predis/Autoloader.php';
Predis\Autoloader::register();

$redis = new Predis\Client(array(
    'host' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_HOST),
    'port' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PORT),
    'password' => parse_url($_ENV['REDISCLOUD_URL'], PHP_URL_PASS),
));

switch ($_GET["a"]) {
  case "set":
    echo $redis->set("welcome_msg", "Hello from Redis!");
    break;
  case "get":
    echo $redis->get("welcome_msg");
    break;
  case "info":
    foreach ($redis->info() as $key => $value) {
      echo "$key: $value<br />\n";
    }    
    break;
  case "flush":
    echo $redis->flushdb();
    break;
  default:
    echo "";
    break;    
}
?>
