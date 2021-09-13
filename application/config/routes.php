<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'LoginController';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']  = 'LoginController/index';
$route['auth']   = 'LoginController/auth';
$route['logout'] = 'LoginController/logout';

$route['dashboard'] = 'DashboardController/index';

$route['admin_management']        = 'AdminManagementController/index';
$route['admin_management/store']  = 'AdminManagementController/store';
$route['admin_management/update'] = 'AdminManagementController/update';
$route['admin_management/delete'] = 'AdminManagementController/delete';
$route['admin_management/reset']  = 'AdminManagementController/reset';

$route['ruangan']       		= 'RuanganController/index';
$route['ruangan/add']   		= 'RuanganController/add';
$route['ruangan/store'] 		= 'RuanganController/store';
$route['ruangan/edit/(:num)'] 	= 'RuanganController/edit/$1';
$route['ruangan/update'] 		= 'RuanganController/update';
$route['ruangan/delete'] 		= 'RuanganController/delete';

$route['barang']       					= 'BarangController/index';
$route['barang/add']   					= 'BarangController/add';
$route['barang/store'] 					= 'BarangController/store';
$route['barang/edit/(:num)'] 			= 'BarangController/edit/$1';
$route['barang/update'] 				= 'BarangController/update';
$route['barang/delete'] 				= 'BarangController/delete';
$route['barang/show_ukuran/(:num)'] 	= 'BarangController/show_ukuran/$1';

$route['ukuran']       					= 'UkuranController/index';
$route['ukuran/add']   					= 'UkuranController/add';
$route['ukuran/store'] 					= 'UkuranController/store';
$route['ukuran/edit/(:num)'] 			= 'UkuranController/edit/$1';
$route['ukuran/update'] 				= 'UkuranController/update';
$route['ukuran/delete'] 				= 'UkuranController/delete';
$route['ukuran/print/(:num)'] 			= 'UkuranController/print/$1';

$route['history_laundry'] = 'HistoryLaundryController/index';

$route['scan']      = 'ScanController/index';
$route['scan/kode'] = 'ScanController/cek_kode';
$route['scan/store'] = 'ScanController/store';

$route['init']         = 'InitController/init';
