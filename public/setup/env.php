<?php

if (!defined('APP_NAME'))                       define('APP_NAME', 'Afya App');
if (!defined('APP_ORGANIZATION'))               define('APP_ORGANIZATION', 'TT');
if (!defined('APP_OWNER'))                      define('APP_OWNER', 'Kelvince');
if (!defined('APP_DESCRIPTION'))                define('APP_DESCRIPTION', 'Patients Registration and Visits');

if (!defined('ALLOWED_INACTIVITY_TIME'))        define('ALLOWED_INACTIVITY_TIME', time()+1*60);

if (!defined('DB_DATABASE'))                    define('DB_DATABASE', 'afya_app_db');
if (!defined('DB_HOST'))                        define('DB_HOST','127.0.0.1');
if (!defined('DB_USERNAME'))                    define('DB_USERNAME','root');
if (!defined('DB_PASSWORD'))                    define('DB_PASSWORD' ,'');
if (!defined('DB_PORT'))                        define('DB_PORT' ,'3306');

?>
