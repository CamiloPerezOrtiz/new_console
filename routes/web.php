<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groups', 'GroupController@showGroups')->name('showGroups');
Route::get('/new-group', 'GroupController@createGroup')->name('createGroup');
Route::post('/new-group', 'GroupController@createGroupPost')->name('createGroupPost');
Route::get('/show-devices/{id}', 'GroupController@showDevices')->name('showDevices');
Route::get('/new-device/{id}', 'GroupController@createDevice')->name('createDevice');
Route::post('/new-device', 'GroupController@createDevicePost')->name('createDevicePost');
Route::get('/show-interfaces/{id}', 'GroupController@showInterfaces')->name('showInterfaces');
Route::get('/new-interface/{id}', 'GroupController@createInterface')->name('createInterface');
Route::post('/new-interface', 'GroupController@createInterfacePost')->name('createInterfacePost');
/*
select * from users;

select * from "groups";

insert into "groups"(name, campus, interfase, name_interfase, type_interfase, 
ip_interfase, created_at, updated_at) values
	('warriors','warriors_labs','WAN','AXTEL','em0','192.168.1.1', NOW(), NOW());
	
insert into users(name, lastname, email, "password", "role", group_id, created_at, updated_at) values
	('Super', 'Administrator', 'admin@warriorslabs.com', '$2y$10$ytK9EKAs1wnDiQlhktEfPuzNxgFh.sRQsOY.X4EbOba56SBKGN26S', 'SUPER', 1, NOW(), NOW());
	
select * from "groups";
select * from users;
select * from campus;
select * from interfaces;

insert into "groups"(name, created_at, updated_at) values('warriors', now(), now());

delete from "groups" where id = 4;
 */