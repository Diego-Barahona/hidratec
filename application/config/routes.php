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
//views Login
$route['default_controller'] = 'Home/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['api/login']['POST'] = 'Login/login_user';
$route['api/logout']['POST'] = 'Login/logout';
$route['api/load_page']['GET']= 'Home/load_page';
$route['api/recovery_email']['POST']= 'Login/recovery_email';
$route['api/recovery']['POST']= 'Login/recovery';
$route['api/new_password']['POST']= 'Login/new_password';
/* $route['login']['GET']= 'Login/index'; */

//views admin OT 
$route['newOrder']['GET']='Orders/newOrder'; //view load create new order
$route['api/createOrder']['POST']='Orders/createOrder'; //controller action create new order
$route['adminImages']['GET']='Images/adminImages/$1';
$route['stagesOrder']['GET']='Orders/stagesOrder';
$route['newUpdateOrder']['GET']='Orders/newUpdateOrder';
$route['api/updateOrder']['POST']='Orders/updateOrder';
$route['api/changeStateOrder']['POST']='Orders/changeStateOrder';
$route['adminOrders']['GET']='Orders/adminOrders';
$route['api/getOrders']['GET']='Orders/getOrders';
$route['api/getFieldsOrder']['GET']='Orders/getFieldsOrder';

//view counter

$route['counterOrders']['GET']='Counter/counterOrders';



//views admin resources
$route['adminComponent']['GET']='Component/adminComponent';
$route['adminBrand']['GET']='Brand/adminBrand';
$route['adminSubtask']['GET']='Subtask/adminSubtask';
$route['adminLocation']['GET']='Location/adminLocation';

/*api admin enterprise*/
$route['api/enterprise']['GET']= 'Enterprise/index';
$route['api/get_enterprises']['GET']= 'Enterprise/list';
$route['api/create_enterprise']['POST']= 'Enterprise/create';
$route['api/update_enterprise']['POST']= 'Enterprise/update';
$route['api/des_hab_enterprise']['POST']= 'Enterprise/des_hab';

/*api admin user*/
$route['api/user']['GET']= 'User/index';
$route['api/get_users']['GET']= 'User/list';
$route['api/create_user']['POST']= 'User/create';
$route['api/update_user']['POST']= 'User/update';
$route['api/des_hab_user']['POST']= 'User/des_hab';

/*api admin client*/
$route['api/client']['GET']= 'Client/index';
$route['api/get_clients']['GET']= 'Client/list';
$route['api/create_client']['POST']= 'Client/create';
$route['api/update_client']['POST']= 'Client/update';
$route['api/des_hab_client']['POST']= 'Client/des_hab';


//api admin resources 
//(Location)
$route['api/createLocation']['POST']='Location/createLocation';
$route['api/editLocation']['POST']='Location/editLocation';
$route['api/changeStateLocation']['POST']='Location/changeState';
$route['api/getLocation']['GET']='Location/getLocation';
//(Substask)
$route['api/createSubtask']['POST']='Subtask/createSubtask';
$route['api/editSubtask']['POST']='Subtask/editSubtask';
$route['api/changeStateSubtask']['POST']='Subtask/changeState';
$route['api/getSubtask']['GET']='Subtask/getSubtask';
//(Component)
$route['api/createComponent']['POST']='Component/createComponent';
$route['api/editComponent']['POST']='Component/editComponent';
$route['api/changeStateComponent']['POST']='Component/changeState';
$route['api/getComponent']['GET']='Component/getComponent';
//(Brand)
$route['api/createBrand']['POST']='Brand/createBrand';
$route['api/editBrand']['POST']='Brand/editBrand';
$route['api/changeStateBrand']['POST']='Brand/changeState';
$route['api/getBrand']['GET']='Brand/getBrand';


//api admin images OT

$route['api/addImage']['POST']  = 'Images/addImage';
$route['api/upImage/(:num)']['POST']  = 'Images/upImage/$1';
$route['api/getImagesByOrder/(:num)']['GET']  = 'Images/getImagesByOrder/$1';
$route['api/editImage/(:num)']['POST']  = 'Images/editImage/$1';

//api counter
$route['api/counterOrders']['GET'] = 'Counter/getData';

//api evaluation 
$route['api/getEvaluationByOrder/(:num)']['GET'] = 'Evaluation/getEvaluationByOrder/$1';
$route['api/editEvaluation/(:num)']['POST'] = 'Evaluation/editEvaluation/$1';





