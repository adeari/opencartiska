<?php
// HTTP
$shoFBAcc = true;
if (strcmp($_SERVER['HTTP_HOST'],"iska.tit")==0) {
	$shoFBAcc = false;
}
define('showFBIT', $shoFBAcc);
$myServer = 'http://'.$_SERVER['HTTP_HOST'].'/';
define('HTTP_SERVER', $myServer);

// HTTPS
define('HTTPS_SERVER', $myServer);

// DIR
$direki = __DIR__."/";
define('DIR_APPLICATION', $direki.'catalog/');
define('DIR_SYSTEM', $direki.'system/');
define('DIR_DATABASE', $direki.'system/database/');
define('DIR_LANGUAGE', $direki.'catalog/language/');
define('DIR_TEMPLATE', $direki.'catalog/view/theme/');
define('DIR_CONFIG', $direki.'system/config/');
define('DIR_IMAGE', $direki.'image/');
define('DIR_CACHE', $direki.'system/cache/');
define('DIR_DOWNLOAD', $direki.'download/');
define('DIR_LOGS', $direki.'system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'ade');
define('DB_DATABASE', 'opencartiska');
define('DB_PASSWORD', '123');
define('DB_PREFIX', 'oc_');
?>