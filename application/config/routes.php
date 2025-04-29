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


/***
codeigniter hide controller name in url
https://stackoverflow.com/questions/2991323/how-to-hide-controller-name-in-the-url-in-codeigniter
**/

$route['default_controller'] = "Main";
//$route['default_controller'] = "Welcome";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



// $route['([a-zA-Z0-9_-]+)-weds-([a-zA-Z0-9_-]+)/([0-9]+)'] = 
// 		'wedevent/event/$1-weds-$2/$3';

$route['([a-zA-Z0-9_-]+)-weds-([a-zA-Z0-9_-]+)'] = 
		'wedevent/event/$1-weds-$2/';
		

$route['register'] = 'main/register';
$route['payments'] = 'payments/index';

$route['blogs'] = 'blogs/index';

$route['blogs/(:any)'] = 'blogs/single/$1';

$route['contact'] = 'page/contact';
$route['([a-zA-Z0-9_-]+)'] = 'page/dynamic_page/$1';
if(0)
{



}

/* End of file routes.php */
/* Location: ./application/config/routes.php */