<?php
//see:
// /framework/conf/ConfigureFromEnv.php
// http://doc.silverstripe.org/framework/en/topics/environment-management


define('SS_ENVIRONMENT_TYPE', 'live'); //dev/test/live

/* Database connection */

define('SS_DATABASE_CLASS', 'MySQLDatabase');
define('SS_DATABASE_SERVER', '46.32.240.45');
define('SS_DATABASE_NAME', 'shcha-ut5-u-233418');
define('SS_DATABASE_USERNAME', 'shcha-ut5-u-233418');
define('SS_DATABASE_PASSWORD', 'z!wesDRED');

/* Configure a default username and password to access the CMS on all sites in this environment. */
define('SS_DEFAULT_ADMIN_USERNAME', 'webmaster@7dots.co.uk');
define('SS_DEFAULT_ADMIN_PASSWORD', 'ch411c0n');

define('SS_SEND_ALL_EMAILS_TO', 'nivsuresh06@gmail.com'); //useful for testing
define('SS_SEND_ALL_EMAILS_FROM', 'nivsuresh06@gmail.com'); //useful for testing

define('SS_ERROR_LOG', '/log/ss/silverstripe.log');

//custom definitions
define('ADMIN_EMAIL_FROM', 'nivsuresh06@gmail.com');
define('ADMIN_EMAIL_TO', 'nivsuresh06@gmail.com');

