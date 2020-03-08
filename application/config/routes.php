<?php
defined('BASEPATH') or exit('No direct script access allowed');

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




// Site routes

$route['default_controller'] = 'index/home';
$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
// $route['quick_login'] = 'index/quick_login';
// $route['create_account'] = 'index/create_account';
// $route['categories/(:any)'] = 'categories/single/$1';



// Apanel Routes

$route['apanel/home'] = 'apanel/index/home';
$route['apanel/slider'] = 'apanel/slider/index';
$route['apanel/site_settings'] = 'apanel/index/site_settings';
// $route['apanel/site_themes'] = 'apanel/index/site_themes';
$route['apanel/admin_profile'] = 'apanel/index/admin_profile';
$route['apanel/change_pswd'] = 'apanel/index/change_pswd';
$route['apanel/site_contact'] = 'apanel/index/site_contact';
$route['apanel/site_social'] = 'apanel/index/site_social';

// $route['apanel/home_sections'] = 'apanel/index/home_sections';
// $route['apanel/banners'] = 'apanel/index/banners';
$route['apanel/login'] = 'apanel/index/login';
$route['apanel/logout'] = 'apanel/index/logout';
$route['(:any)/edit/(:any)'] = '?edit/$1';
// $route['apanel/gallery/(:any)'] = 'apanel/products/product_images/$1';
$route['apanel/manage_admins'] = 'apanel/index/manage_admins';
$route['apanel/manage_admins/add'] = 'apanel/index/add_admin';
$route['apanel/manage_admins/edit/(:any)'] = 'apanel/index/edit_admin/$1';

$route['apanel/admin_delete/(:any)'] = 'apanel/index/admin_delete/$1';
$route['apanel/inbox'] = 'apanel/mails/index';
$route['apanel/sent'] = 'apanel/mails/sent';
$route['apanel/compose'] = 'apanel/mails/compose';
$route['apanel/inbox/(:any)/(:any)'] = 'apanel/mails/read/$1/$2';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
