<?php
$memcache_obj = memcache_connect('59.127.108.20', 9901);
memcache_flush($memcache_obj);
$memcache_obj = new Memcache;
$memcache_obj->connect('59.127.108.20', 9901);
echo $memcache_obj->flush();

echo "清除 memcache 完成";
?>