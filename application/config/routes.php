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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Static Route */
$route['About'] = 'Home/about';
$route['Terms'] = 'Home/terms';
$route['Privacy-Policy'] = 'Home/privacy';
$route['Refund-Policy'] = 'Home/refund';
$route['Faqs'] = 'Home/faqs';

$route['Change-Password'] = 'Users/password';
$route['Logout'] = 'Users/logout';

$route['Course/(:any)'] = 'Home/get_course/$1';
$route['Category/(:any)'] = 'Home/get_category/$1';


$route['Contact-Request'] = 'Home/contact_request';

/* Admin Routes */
$route['Admin'] = 'Admin';
$route['Update-Admin'] = 'Admin_Dashboard/update_profile';
$route['Update-Admin-Password'] = 'Admin_Dashboard/update_password';
$route['Admin-Login'] = 'Admin/login';
$route['Dashboard'] = 'Admin_Dashboard';
$route['Admin-Profile'] = 'Admin_Dashboard/profile';

$route['Admin-Courses'] = 'Admin_Courses';
$route['Admin-Courses/Add'] = 'Admin_Courses/add_course';
$route['Admin-Courses/delete'] = 'Admin_Courses/delete_course';
$route['Admin-Courses/Get/(:any)'] = 'Admin_Courses/get_course/$1';
$route['Admin-Courses/Update'] = 'Admin_Courses/update_course';

$route['Course-Categories'] = 'Admin_Courses/categories';
$route['Admin-Category/Add'] = 'Admin_Courses/add_category';
$route['Admin-Category/delete'] = 'Admin_Courses/delete_category';
$route['Admin-Category/Get/(:any)'] = 'Admin_Courses/get_category/$1';
$route['Admin-Category/Update'] = 'Admin_Courses/update_category';

$route['Admin-News'] = 'Admin_News';
$route['Admin-News/Get/(:any)'] = 'Admin_News/get_news/$1';
$route['Admin-News/Add'] = 'Admin_News/add_news';
$route['Admin-News/delete'] = 'Admin_News/delete_news';
$route['Admin-News/Update'] = 'Admin_News/update_news';

$route['Emails-Management'] = 'Admin_Emails';
$route['Admin-Emails/Update'] = 'Admin_Emails/update_email';

$route['Playlist-Management/(:any)'] = 'Admin_Playlist/index/$1';
$route['Playlist/Add'] = 'Admin_Playlist/add_course';
$route['Playlist/Delete'] = 'Admin_Playlist/delete_course';
$route['Playlist/Get/(:any)'] = 'Admin_Playlist/get/$1';
$route['Playlist/Update'] = 'Admin_Playlist/update_course';

$route['Admin-Contact'] = 'Admin_Contacts';
$route['Admin-Contact/delete'] = 'Admin_Contacts/delete_enquiry';

$route['Reviews-Management'] = 'Admin_Reviews';
$route['Reviews/Add'] = 'Admin_Reviews/add_review';
$route['Reviews/Get/(:any)'] = 'Admin_Reviews/get_review/$1';
$route['Reviews/Delete'] = 'Admin_Reviews/delete_review';
$route['Reviews/Update'] = 'Admin_Reviews/update_review';

$route['Admin-Deals'] = 'Admin_Deals';
$route['Admin-Deals/Get/(:any)'] = 'Admin_Deals/get_deal/$1';
$route['Admin-Deals/Add'] = 'Admin_Deals/add_deal';
$route['Admin-Deals/delete'] = 'Admin_Deals/delete_deal';
$route['Admin-Deals/Update'] = 'Admin_Deals/update_deal';

$route['Admin-Urls'] = 'Admin_Urls';
$route['Admin-Urls/Update'] = 'Admin_Urls/update_url';

$route['Admin-Highlights'] = 'Admin_Urls/highlights';
$route['Admin-Highlights/Update'] = 'Admin_Urls/update_highlights';

$route['Faqs-Management'] = 'Admin_Faqs';
$route['Faqs-Management/Add'] = 'Admin_Faqs/add_faq';
$route['Faqs-Management/delete'] = 'Admin_Faqs/delete_faq';
$route['Faqs-Management/Get/(:any)'] = 'Admin_Faqs/get_faq/$1';
$route['Faqs-Management/Update'] = 'Admin_Faqs/update_faq';
