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
#Raiz#
Route::get('/', function () {
    return view('welcome');
});
#LOGIN#
Auth::routes();
#Grupos#
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groups', 'GroupController@showGroups')->name('showGroups');
Route::get('/new-group', 'GroupController@createGroup')->name('createGroup');
Route::post('/new-group', 'GroupController@createGroupPost')->name('createGroupPost');
Route::get('/edit-group/{id}', 'GroupController@editGroup')->name('editGroup');
Route::post('/edit-group/{id}', 'GroupController@editGroupPost')->name('editGroupPost');
Route::get('/show-users/{id}', 'GroupController@showUsers')->name('showUsers');
Route::get('/new-user/{id}', 'GroupController@createUser')->name('createUser');
Route::post('/new-user/{id}', 'GroupController@createUserPost')->name('createUserPost');
Route::get('/edit-user/{id}', 'GroupController@editUser')->name('editUser');
Route::post('/edit-user/{id}', 'GroupController@editUserPost')->name('editUserPost');
Route::get('/delete-user/{id}', 'GroupController@deleteUser')->name('deleteUser');
Route::get('/show-devices/{id}', 'GroupController@showDevices')->name('showDevices');
Route::get('/new-device/{id}', 'GroupController@createDevice')->name('createDevice');
Route::post('/new-device', 'GroupController@createDevicePost')->name('createDevicePost');
Route::get('/show-interfaces/{id}', 'GroupController@showInterfaces')->name('showInterfaces');
Route::get('/new-interface/{id}', 'GroupController@createInterface')->name('createInterface');
Route::post('/new-interface', 'GroupController@createInterfacePost')->name('createInterfacePost');
Route::get('/edit-interface/{id}', 'GroupController@editInterface')->name('editInterface');
Route::post('/edit-interface/{id}', 'GroupController@editInterfacePost')->name('editInterfacePost');
Route::get('/delete-interface/{id}', 'GroupController@deleteInterface')->name('deleteInterface');
#TARGET CATEGORIES#
Route::get('/show-groups-target-categories', 'TargetController@showGroupsTarget')->name('showGroupsTarget');
Route::get('/show-devices-target-categories/{id}', 'TargetController@showDevicesTarget')->name('showDevicesTarget');
Route::get('/show-target-categories-device/{id}/{name}', 'TargetController@showTargetDevice')->name('showTargetDevice');
Route::get('/new-target-categories-device/{id}', 'TargetController@createTargetDevice')->name('createTargetDevice');
Route::post('/new-target-categories-device/{id}', 'TargetController@createTargetDevicePost')->name('createTargetDevicePost');
Route::get('/edit-target-categories-device/{name}/{id}/{campus}', 'TargetController@editTargetDevice')->name('editTargetDevice');
Route::post('/edit-target-categories-device/{name}/{id}/{campus}', 'TargetController@editTargetDevicePost')->name('editTargetDevicePost');
Route::get('/delete-target-categories-device/{name}/{id}/{campus}', 'TargetController@deleteTargetDevice')->name('deleteTargetDevice');
#ACL GROUPS#
Route::get('/show-groups-acl-groups', 'AclController@showGroupsAcl')->name('showGroupsAcl');
Route::get('/show-devices-acl-groups/{id}', 'AclController@showDevicesAcl')->name('showDevicesAcl');
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