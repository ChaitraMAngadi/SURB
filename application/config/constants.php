<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$url .= "://" . $_SERVER['HTTP_HOST'];
$url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('ADMIN_ASSETS_PATH', $url . "admin_assets/");
define('SHOP_LOGOS_PATH', $url . "uploads/shops/");
define('CATEGORIES_PATH', $url . "uploads/categories/");
define('SUB_CATEGORIES_PATH', $url . "uploads/sub_categories/");
define('DEFAULT_IMAGE_PATH', $url . "uploads/noproduct.png");
define('PRODUCTS_PATH', $url . "uploads/noproduct.png");
define("DEFAULT_CURRENCY", "INR");

//Mail SMTP Settings
define("MAIL_PROTOCOL", 'smtp');
define("MAIL_CHARSET", 'utf-8');
define("MAIL_SMTP_HOST", 'smtp-relay.sendinblue.com');
// define("MAIL_SMTP_HOST", 'smtp-relay.brevo.com');

define("MAIL_SMTP_USER", 'no-reply@absolutemens.com');
// define("MAIL_SMTP_PASS", 'z896MhVDwxHLKtyk');
define("MAIL_SMTP_PASS",'6grzLwEBJFvUDc9f');
define("MAIL_SMTP_PORT", 587);

//Payment gateway credentials
// Test Key
define("TEST_SECRET_KEY", '84524e72ab1a4e7a7d05bafad4c548785a23a4a7');
define("TEST_APP_ID", '116600e5f57491cb82375404e1006611');

// Live Key
// define("TEST_SECRET_KEY", '7039421e4258841662712e5aff617630dba61765');
// define("TEST_APP_ID", '1659324bde24632fe0e4ed85dd239561');

// PhonePe gateway test details
// define("PAY_URL", "https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay");
// define("API_END_POINT", "/pg/v1/pay");
// define("MERCHANT_ID", 'PHONEPEPGUAT'); 
// define("SALT_KEY", 'c817ffaf-8471-48b5-a7e2-a27e5b7efbd3');
// define("KEY_INDEX", '1');

define("PAY_URL", "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay");
define("API_END_POINT", "/pg/v1/pay");
define("MERCHANT_ID", 'ABSOLUTEMENSONLINEUAT');
define("SALT_KEY", 'ace28b31-b863-4af2-ab8e-cd175d269b03');
define("KEY_INDEX", '1');
//PhonePe gateway live details

// define("PAY_URL", "https://api.phonepe.com/apis/hermes/pg/v1/pay");
// define("API_END_POINT", "/pg/v1/pay");
// define("MERCHANT_ID", 'ABSOLUTEMENSONLINE'); 
// define("SALT_KEY", 'faa85917-9701-413a-b7ef-4f3b319b03a8');
// define("KEY_INDEX", '1');


//refund phonepe
define("REFUND_URL", "https://api.phonepe.com/apis/hermes/pg/v1/refund");
define("REFUND_API_END_POINT", "/pg/v1/refund");


//live keys for delhivery
// define("USER_NAME", "8eced9-ABSOLUTEMENSCOMFASHI-do");
// define("TEST_KEY","935ae9ce229ce4397164e0fc3f87013f23b382b8");
// define("PIN_URL","https://track.delhivery.com/c/api/pin-codes/json/");
// define("WAREHOUSE_URL","https://track.delhivery.com/api/backend/clientwarehouse/create/");
// define("WAREHOUSE_EDIT_URL","https://track.delhivery.com/api/backend/clientwarehouse/edit/");
// define("WAY_BILL_URL","https://track.delhivery.com/waybill/api/bulk/json/");
// define("SHIPMENT_CREATE_URL","https://track.delhivery.com/api/cmu/create.json");
// define("SHIPMENT_UPDATE_URL","https://track.delhivery.com/api/p/edit");
// define("TRACKING_URL","https://track.delhivery.com/api/v1/packages/json/");
// define("SHIPPING_COST_URL","https://track.delhivery.com/api/kinko/v1/invoice/charges/.json");
// define("SHIPPING_LABEL_URL","https://track.delhivery.com/api/p/packing_slip");
// define("PICKUP_URL","https://track.delhivery.com/​fm/request/new/");
// define("NDR_URL","https://track.delhivery.com/api/p/update");


//test keys for delhivery API
define("TEST_KEY","81b46fee5028f79840ab568b7bf88a65ec6d67ea");
define("WAREHOUSE_LOCATION","BARTEST-B2C");
define("USER_NAME","BARTEST-B2C");
define("PIN_URL","https://staging-express.delhivery.com/c/api/pin-codes/json/");
define("WAREHOUSE_URL","https://staging-express.delhivery.com/api/backend/clientwarehouse/create/");
define("WAREHOUSE_EDIT_URL","https://staging-express.delhivery.com/api/backend/clientwarehouse/edit/");
define("WAY_BILL_URL","https://staging-express.delhivery.com/waybill/api/bulk/json/");
define("SHIPMENT_CREATE_URL","https://staging-express.delhivery.com/api/cmu/create.json");
define("SHIPMENT_UPDATE_URL","https://staging-express.delhivery.com/api/p/edit");
define("TRACKING_URL","https://staging-express.delhivery.com/api/v1/packages/json/");
define("SHIPPING_COST_URL","https://staging-express.delhivery.com/api/kinko/v1/invoice/charges/.json");
define("SHIPPING_LABEL_URL","https://staging-express.delhivery.com/api/p/packing_slip");
define("PICKUP_URL","https://staging-express.delhivery.com/fm/request/new/");
define("NDR_URL","https://staging-express.delhivery.com/api/p/update");


define("BREVO_ENDPOINT","https://api.brevo.com/v3/smtp/email");
define("BREVO_APIKEY","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");