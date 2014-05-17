<?php
// HTTP
$shoFBAcc = true;
if (strcmp($_SERVER['HTTP_HOST'],"iska.tit")==0) {
	$shoFBAcc = false;
}
define('showFBIT', $shoFBAcc);
define('apikeyongkir', 'f7da17c2d33e2079d2fc7a2efd38c499');
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
define('DB_USERNAME', 'mfshoppu_user');
define('DB_DATABASE', 'mfshoppu_data');
define('DB_PASSWORD', 'e45UOrt6ert');
define('DB_PREFIX', 'oc_');
?>