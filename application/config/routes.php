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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = 'home/not_page';
$route['401'] = 'home/no_role';
$route['translate_uri_dashes'] = TRUE;

//router of blog

$route['post/(:any)']='post/view/$1';

//account is user
$route['account/home'] = 'back_end/account/home';

//route of accout
$route['back_end'] = 'back_end/authentication';
$route['admin/home'] = 'back_end/authentication/home';
$route['login'] = 'back_end/Authentication/login';
$route['register'] = 'back_end/Authentication/register';


$route['account/(:any)'] = 'back_end/account/$1';
//$route['account/update_info'] = 'back_end/account/update_info';
//$route['account/change_password'] = 'back_end/account/change_password';
$route['account/logout'] = 'back_end/authentication/logout';

//for category
$route['admin/category/(:any)'] = 'back_end/category/$1';
$route['admin/category/edit_category/(:any)'] = 'back_end/category/edit_category/$1';
$route['admin/category/delete/(:any)'] = 'back_end/category/delete/$1';

//for post
$route['admin/post/(:any)'] = 'back_end/post/$1';
$route['admin/post/edit_post/(:any)'] = 'back_end/post/edit_post/$1';
$route['admin/post/post_by_category/(:any)'] = 'back_end/post/post_by_category/$1';
$route['admin/post/delete/(:any)'] = 'back_end/post/delete/$1';
$route['admin/post/search_post/(:any)'] = 'back_end/post/search_post/$1';


$route['admin/(:any)'] = 'back_end/$1';
//$route['admin/post'] = 'back_end/post';
//$route['admin/post/index'] = 'back_end/post/index';
//$route['admin/post/new'] = 'back_end/post/new_post';
//$route['admin/post/edit/(:num)'] = 'back_end/post/edit_post/$1';
//$route['admin/post/delete'] = 'back_end/post/delete';
//$route['admin/post/show_categry'] = 'back_end/post/show_categry';
//$route['admin/post/search_post'] = 'back_end/post/search_post';
//for category