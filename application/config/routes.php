<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

# $route['default_controller'] = "frontpage";
# $route['404_override'] = '';

$route['backend'] = "auth/login";

$default_controller = "frontpage";
$language_alias = array('en','id');
$controller_exceptions = array('backend', 'auth/*', 'solr');

$route['default_controller'] = $default_controller;
$route["^(".implode('|', $language_alias).")/(".implode('|', $controller_exceptions).")(.*)"] = '$2';
$route["^(".implode('|', $language_alias).")?/(.*)"] = $default_controller.'/$2';
$route["^((?!\b".implode('\b|\b', $controller_exceptions)."\b).*)$"] = $default_controller.'/$1';

foreach($language_alias as $language)
	$route[$language] = $default_controller.'/index';

$route['404_override'] = '404.php';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
