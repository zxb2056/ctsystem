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
// //redis测试点赞功能
Route::get('/testRedis','RedisController@testRedis')->name('testRedis');
// //测试wangeditor
// Route::get('/wangeditor','AdminController@wang');
// Route::get('/nihao','AdminController@loginview');  
// 测试数据库连接页面
Route::any('/test','ClientController@test');
Route::get('/test/tupian','ClientController@testtupian');
//主页面
Route::get('/','ClientController@index');
Route::get('/about.html', 'ClientController@about');
Route::get('/zhaopin.html', 'ClientController@hire');
Route::get('/zp/01.html','ClientController@hireDetail');
Route::get('/news.html','ClientController@news');
Route::get('/djfp.html','ClientController@djfp');
Route::get('/tech.html','ClientController@tech');
Route::get('/qyyx.html','ClientController@qyyx');
Route::get('/qyyx/video.html','ClientController@qyyxVideo');
//文章详情页
Route::get('/{news}/{id}','ClientController@postdetail');

//提交评论
Route::post('/posts/{post}/comment','PostController@comment');
//赞功能
Route::get('/posts/{post_id}/zan','PostController@zan');
Route::get('/posts/{post_id}/unzan','PostController@unzan');

//注册登录页面
//注册页面
Route::get('/register.html','RegisterController@index');
//注册行为
Route::post('/register','RegisterController@register');
//登陆页面
Route::get('/login.html','LoginController@index')->name('login');
//登陆行为
Route::post('/login','LoginController@login');
//登出行为
Route::get('/logout','LoginController@logout');
Route::group(['middleware' => 'auth:web'], function(){
//个人设置操作
Route::get('/user/me/setting','UserController@setting');
//个人设置操作
Route::post('/user/me/setting','UserController@settingstore');
});

//后台页面

Route::group(['prefix'=>'/admin'],function(){
    //后台管理员注册行为
Route::post('/login/register','AdminController@register');
 //登录页面
 Route::get('/login/denglu','AdminController@loginview');  
 Route::post('/login/denglu','AdminController@login');
 Route::get('/login/logout','AdminController@logout');

Route::group(['middleware'=>'auth:admin'],function(){

Route::get('/','AdminController@index');
//文章创建页面
Route::get('/post/postinput','PostController@input');
Route::post('/post/store','PostController@store');
Route::any('/post/settype','PostController@settype');
//文章图片上传
Route::post('/posts/image/upload','PostController@imageUpload');
//文章列表页
Route::get('/post/postlist','PostController@list');
//文章编辑页
Route::get('/post/{post}/edit','PostController@edit');
Route::post('/post/update','PostController@update');

//文章删除页
Route::get('/post/{id}/delete','PostController@delete');
//公告板输入页面
Route::get('/post/bulletin-board','PostController@bulletin');
Route::post('/post/bulletin/store','PostController@bulletinstore');
//公告板列表
Route::get('/post/bulletinlist','PostController@bulletinlist');
//公告编辑
Route::get('/post/{id}/bulletin-edit','PostController@bulletin_edit');
//公告更新
Route::post('/post/bulletin/update','PostController@bulletin_update');
//公告删除
Route::get('/post/{id}/bulletin-delete','PostController@bulletin_delete');
//视频列表
Route::get('/post/video','PostController@video');
//视频存储
Route::post('/video/store','PostController@videostore');
//视频编辑
Route::post('/video/video-update','PostController@videoUpdate');
//视频删除
Route::get('/video/delete/{id}','PostController@videoDelete');
//图片列表
Route::get('/post/picture','PostController@picture');
//图片存储
Route::post('/photo/store','PostController@photostore');
//图片更新
Route::post('/photo/photo-update','PostController@photoUpdate');
//图片删除
Route::get('/photo/delete/{id}','PostController@photoDelete');
//编辑器图片实时删除
Route::get('/photo/edit/delete','PostController@editorphotoDelete');
//评论审核页面
Route::get('/post/{postid}/examcommen','PostController@examcommen');

//评论审核行为
Route::post('/comment/{commentid}/status','PostController@status');

Route::group(['middleware'=>'can:sys-manager'],function(){
//管理人员模块
Route::get('/users/index','\App\Admin\controllers\UserController@index');
Route::post('/users/store','\App\Admin\controllers\UserController@store');

//检查用户是否有某个角色,储存角色
Route::get('/users/{user}/role','\App\Admin\controllers\UserController@role');
Route::post('/users/{user}/role','\App\Admin\controllers\UserController@storeRole');

//对管理人员进行更新（修改密码等）
Route::get('/users/{userid}/edit','\App\Admin\controllers\UserController@edit');
Route::post('/users/{userid}/update','\App\Admin\controllers\UserController@update');
//对后台人员进行删除，实行软删除，即永久保存员工操作记录，但列表里不再显示。
Route::get('/users/{userid}/delete','\App\Admin\controllers\UserController@delete');
//角色相关
Route::get('/roles/index','\App\Admin\Controllers\RoleController@index');
Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');
Route::post('/roles/update','\App\Admin\Controllers\RoleController@update');
Route::get('/roles/{role}/permission','\App\Admin\controllers\RoleController@permission');
Route::post('/roles/{role}/permission','\App\Admin\controllers\RoleController@storePermission');
Route::get('/roles/{roleid}/delete','\App\Admin\controllers\RoleController@deleterole');
//权限模块
Route::get('/permissions/index','\App\Admin\Controllers\PermissionController@index');
Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');
Route::post('/permissions/{id}/update','\App\Admin\Controllers\PermissionController@update');


});//gate end
//基础数据部分
Route::get('/manage/basic/cattleinfo','\App\Admin\Controllers\farm\BasicController@index');
Route::get('/manage/basic/barninfo','\App\Admin\Controllers\farm\BasicController@barninfo');
Route::get('/manage/basic/semen','\App\Admin\Controllers\farm\BasicController@semen');
//繁育部分
Route::get('/manage/breed/mateInput','\App\Admin\Controllers\farm\BreedController@mateInput');
Route::get('/manage/breed/yunjianinput','\App\Admin\Controllers\farm\BreedController@yunjianInput');
Route::get('/manage/breed/chandu','\App\Admin\Controllers\farm\BreedController@chandu');
Route::get('/manage/breed/aftercare','\App\Admin\Controllers\farm\BreedController@aftercare');
Route::get('/manage/breed/mateplan','\App\Admin\Controllers\farm\BreedController@mateplan');
Route::get('/manage/breed/waitmate','\App\Admin\Controllers\farm\BreedController@waitmate');
Route::get('/manage/breed/fanzhidisease','\App\Admin\Controllers\farm\BreedController@fanzhidisease');
Route::get('/manage/breed/expected_birth','\App\Admin\Controllers\farm\BreedController@expected_birth');
Route::get('/manage/breed/fanzhibaobiao','\App\Admin\Controllers\farm\BreedController@fanzhibaobiao');
//兽医部分
Route::get('/manage/Veterinary/disease_input','\App\Admin\Controllers\farm\VeterController@disease_input');
Route::get('/manage/Veterinary/antiepidemic_batch','\App\Admin\Controllers\farm\VeterController@antiepidemic_batch');
Route::get('/manage/Veterinary/antiepidemic_single','\App\Admin\Controllers\farm\VeterController@antiepidemic_single');
Route::get('/manage/Veterinary/antiepidemic_history','\App\Admin\Controllers\farm\VeterController@antiepidemic_history');
Route::get('/manage/Veterinary/Quarantine_input','\App\Admin\Controllers\farm\VeterController@Quarantine_input');
Route::get('/manage/Veterinary/Quarantine_history','\App\Admin\Controllers\farm\VeterController@Quarantine_history');
Route::get('/manage/Veterinary/trim_hoof_input','\App\Admin\Controllers\farm\VeterController@trim_hoof_input');
Route::get('/manage/Veterinary/trim_hoof_history','\App\Admin\Controllers\farm\VeterController@trim_hoof_history');
Route::get('/manage/Veterinary/repellent_single','\App\Admin\Controllers\farm\VeterController@repellent_single');
Route::get('/manage/Veterinary/repellent_batch','\App\Admin\Controllers\farm\VeterController@repellent_batch');
Route::get('/manage/Veterinary/repellent_history','\App\Admin\Controllers\farm\VeterController@repellent_history');
Route::get('/manage/Veterinary/disinfection_input','\App\Admin\Controllers\farm\VeterController@disinfection_input');
Route::get('/manage/Veterinary/disinfection_history','\App\Admin\Controllers\farm\VeterController@disinfection_history');
//饲养管理
Route::get('/manage/feed/dieOut','\App\Admin\Controllers\farm\FeedController@dieOut');
Route::get('/manage/feed/sell_batch','\App\Admin\Controllers\farm\FeedController@sell_batch');
Route::get('/manage/feed/sell','\App\Admin\Controllers\farm\FeedController@sell');
Route::get('/manage/feed/zhuanshe','\App\Admin\Controllers\farm\FeedController@zhuanshe');
//物资管理
//*.药品。*
Route::get('/manage/material/drugs_input','\App\Admin\Controllers\farm\materialController@drugs_input');
Route::get('/manage/material/drugs_ledger','\App\Admin\Controllers\farm\materialController@drugs_ledger');
Route::get('/manage/material/drugs_output','\App\Admin\Controllers\farm\materialController@drugs_output');
Route::get('/manage/material/drugs_remain','\App\Admin\Controllers\farm\materialController@drugs_remain');
Route::get('/manage/material/drugs_repository','\App\Admin\Controllers\farm\materialController@drugs_repository');
//*.饲料
Route::get('/manage/material/feed_input','\App\Admin\Controllers\farm\materialController@feed_input');
Route::get('/manage/material/feed_ledger','\App\Admin\Controllers\farm\materialController@feed_ledger');
Route::get('/manage/material/feed_output','\App\Admin\Controllers\farm\materialController@feed_output');
Route::get('/manage/material/feed_remain','\App\Admin\Controllers\farm\materialController@feed_remain');
Route::get('/manage/material/feed_repository','\App\Admin\Controllers\farm\materialController@feed_repository');
//器械耗材
Route::get('/manage/material/instru_consum_check','\App\Admin\Controllers\farm\materialController@instru_consum_check');
Route::get('/manage/material/instru_consum_input','\App\Admin\Controllers\farm\materialController@instru_consum_input');
Route::get('/manage/material/instru_consum_output','\App\Admin\Controllers\farm\materialController@instru_consum_output');
Route::get('/manage/material/instru_consum_remain','\App\Admin\Controllers\farm\materialController@instru_consum_remain');
Route::get('/manage/material/instru_consum_ledger','\App\Admin\Controllers\farm\materialController@instru_consum_ledger');
//冻精
Route::get('/manage/material/semen_broke_history','\App\Admin\Controllers\farm\materialController@semen_broke_history');
Route::get('/manage/material/semen_broke','\App\Admin\Controllers\farm\materialController@semen_broke');
Route::get('/manage/material/semen_input','\App\Admin\Controllers\farm\materialController@semen_input');
Route::get('/manage/material/semen_ledger','\App\Admin\Controllers\farm\materialController@semen_ledger');
Route::get('/manage/material/semen_remain','\App\Admin\Controllers\farm\materialController@semen_remain');
//员工
Route::get('/manage/staff/staff_list','\App\Admin\Controllers\farm\StaffController@staff_list');
Route::post('/manage/staff/add_staff','\App\Admin\Controllers\farm\StaffController@add_staff');
Route::post('/manage/staff/edit_staff','\App\Admin\Controllers\farm\StaffController@edit_staff');
//员工--部门管理
Route::get('/manage/staff/partment','\App\Admin\Controllers\farm\StaffController@partment');
Route::post('/manage/staff/addDepart','\App\Admin\Controllers\farm\StaffController@addDepart');
Route::post('/manage/staff/retriveDepart','\App\Admin\Controllers\farm\StaffController@retriveDepart');
Route::get('/manage/staff/department/delete/{id}','\App\Admin\Controllers\farm\StaffController@deletedepart');
Route::post('/manage/staff/department/edit','\App\Admin\Controllers\farm\StaffController@editdepart');
Route::get('/manage/staff/department/truncate','\App\Admin\Controllers\farm\StaffController@truncate');
//员工--请假
Route::get('/manage/staff/offWork','\App\Admin\Controllers\farm\StaffController@offWork');
Route::get('/manage/staff/attendance','\App\Admin\Controllers\farm\StaffController@attendance');
Route::post('/manage/staff/offWork/store','\App\Admin\Controllers\farm\StaffController@offWorkStore');
Route::post('/manage/staff/offwork/update','\App\Admin\Controllers\farm\StaffController@offWorkUpdate');
Route::get('/manage/staff/offwork/delete/{id}','\App\Admin\Controllers\farm\StaffController@offWorkdelete');
//员工--临时工
Route::get('/manage/staff/tmpworker','\App\Admin\Controllers\farm\StaffController@tmpworker_list');
Route::post('/manage/staff/add_tmpworker','\App\Admin\Controllers\farm\StaffController@add_tmpworker');
Route::post('/manage/staff/uploadCode','\App\Admin\Controllers\farm\StaffController@importcode');

});//admin结束
});

