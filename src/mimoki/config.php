<?php
$myServer = 'http://'.$_SERVER['HTTP_HOST'].'/';
// HTTP
define('HTTP_SERVER', $myServer.'mimoki/');
define('HTTP_CATALOG', $myServer);

// HTTPS
define('HTTPS_SERVER', $myServer.'mimoki/');
define('HTTPS_CATALOG', $myServer);

// DIR
$direki = __DIR__;
$direki = str_replace('mimoki','',$direki);
define('DIR_APPLICATION', $direki.'mimoki/');
define('DIR_SYSTEM', $direki.'system/');
define('DIR_DATABASE', $direki.'system/database/');
define('DIR_LANGUAGE', $direki.'mimoki/language/');
define('DIR_TEMPLATE', $direki.'mimoki/view/template/');
define('DIR_CONFIG', $direki.'system/config/');
define('DIR_IMAGE', $direki.'image/');
define('DIR_CACHE', $direki.'system/cache/');
define('DIR_DOWNLOAD', $direki.'download/');
define('DIR_LOGS', $direki.'system/logs/');
define('DIR_CATALOG', $direki.'catalog/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'mfshoppu_user');
define('DB_DATABASE', 'mfshoppu_data');
define('DB_PASSWORD', 'e45UOrt6ert');
define('DB_PREFIX', 'oc_');
?>