<?php
return array(
	'url_base' => 'http://dw-integration.socialgamenet.com/',
	'url_static' => null, // When undefined, it defaults to $config['url_base'] . 'public/'. This should be absolute URL.
	'pdo' => new PDO('mysql:dbname=xhprof;host=127.0.0.1;charset=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode = ""')),
);
