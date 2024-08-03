<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'web';

$route['404_override'] = 'custom404';
$route['translate_uri_dashes'] = FALSE;

$route['admin/admin_logs'] = 'admin/settings/admin_logs';
$route['products'] = 'products';
$route['products/(:any)'] = 'products/category_products/$1';
$route['products/(:any)/(:any)'] = 'products/category_products/$1/$2';
$route['products-filter-by-questionaries'] = 'web/filter_products_by_questionary';
$route['sub-cat-products/(:any)'] = 'products/sub_category_products/$1';
$route['single-product'] = 'web';
$route['single-product/(:any)'] = 'web/product_view/$1';
$route['single-product/(:any)/(:any)'] = 'web/product_view/$1/$2';
$route['my-wishlist'] = 'web/my_wishlist';
$route['single-banner-product'] = 'web';
$route['single-banner-product/(:any)'] = 'web/banner_product_view/$1';
$route['search'] = 'products';
$route['run-python'] = 'PythonController/index';
$route['invoice/(:any)']='web/invoice/$1';
$route['file']='web/file';
// $route['warehouse']='web/createWareHouse';
$route['shippingcost']='web/shippingcost';
$route['vendors/orders/pickUp_update/(:num)/(:num)/(:any)'] = 'vendors/orders/pickUp_update/$1/$2/$3';
$route['vendors/orders/addOrderDetails/(:num)/(:num)/(:any)/(:any)'] = 'vendors/orders/addOrderDetails/$1/$2/$3/$4';
$route['vendors/orders/shipment_delhivery/(:any)'] = 'vendors/orders/shipment_delhivery/$1';
// $route['saveData']='admin/vendor_shops/saveData';
$route['admin/notifications/notification_preferences'] = 'admin/notifications/notification_preferences';
$route['vendors/notifications/notification_preferences'] = 'vendors/notifications/notification_preferences';

//$route['products/(:any)/(:any)'] = 'products/category_products/$1/$2';

$route['admin/Vendors/vendor_Revenue'] = 'admin/Vendors/vendor_Revenue';
$route['admin/add_role'] = 'admin/add_role';
$route['admin/admin_role'] = 'admin/add_role/list_roles';
$route['admin/admin_users'] = 'admin/add_user/list_users';

$route['product'] = 'web';


$route['product/(:any)'] = 'web/product_view/$1';
$route['product/(:any)/(:any)'] = 'web/product_view/$1/$2';
$route['product/(:any)/(:any)/(:any)'] = 'web/product_view/$1/$2/$3';
$route['product/(:any)/(:any)/(:any)'] = 'web/product_view/$1/$2/$3/$4';
$route['product/(:any)/(:any)/(:any)/(:any)'] = 'web/product_view/$1/$2/$3/$4/$5';

