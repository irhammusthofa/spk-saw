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
$route['default_controller'] = 'authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login']        = 'authentication';
$route['user/logout']        = 'authentication/logout';
$route['auth/dologin']      = 'authentication/dologin';
$route['user/dashboard']    = 'dashboard';
$route['user/dashboard/map']= 'dashboard/loadmap';

$route['user/area']         = 'area';
$route['user/area/add']     = 'area/add';
$route['user/area/simpan']     = 'area/save';
$route['user/area/edit/(:any)']     = 'area/edit/$1';
$route['user/area/update/(:any)']     = 'area/update/$1';
$route['user/area/hapus/(:any)']     = 'area/delete/$1';


$route['user/kriteria']         = 'kriteria';
$route['user/kriteria/add']     = 'kriteria/add';
$route['user/kriteria/simpan']     = 'kriteria/save';
$route['user/kriteria/edit/(:any)']     = 'kriteria/edit/$1';
$route['user/kriteria/update/(:any)']     = 'kriteria/update/$1';
$route['user/kriteria/hapus/(:any)']     = 'kriteria/delete/$1';

$route['user/penilaian']         = 'penilaian';
$route['user/penilaian/simpan/(:any)']     = 'penilaian/save/$1';
$route['user/penilaian/edit/(:any)']     = 'penilaian/edit/$1';

$route['user/saw']         = 'saw';
$route['user/saw/cetak']         = 'saw/cetak';
$route['user/saw/cetak/lengkap']         = 'saw/cetak_lengkap';
$route['user/grafik']         = 'grafik';

$route['user/tahun'] = 'tahun/index';
$route['user/tahun/changetahun/(:any)/(:any)'] = 'tahun/changetahun/$1/$2';
$route['user/tahun/add'] = 'tahun/add';
$route['user/tahun/edit/(:any)'] = 'tahun/edit/$1';
$route['user/tahun/hapus/(:any)'] = 'tahun/delete/$1';
$route['user/tahun/simpan'] = 'tahun/save';
$route['user/tahun/update/(:any)'] = 'tahun/update/$1';


$route['user/histori']         = 'histori';