<?php   
$redis = new redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('Magic','http://shejishi.cc');
echo $redis->get('Magic');
?>