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
// 测试路由中调用artisan:list 命令
Route::get('/test/route/artisan_list','RedisController@artisan_list');
// //redis测试点赞功能
Route::get('/testRedis','RedisController@testRedis')->name('testRedis');
// 测试生成月报表，年报表
Route::get('/test/report/month','RedisController@month_report');
Route::get('/test/report/yearly','RedisController@year_report');
// 测试递归
Route::get('/test/report/digui','RedisController@find_last_calv');
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
Route::post('/manage/basic/cattleinfo/pluscattle','\App\Admin\Controllers\farm\BasicController@plusCattle');
Route::post('/manage/basic/cattleinfo/plus_breed_variety','\App\Admin\Controllers\farm\BasicController@plus_breed_variety');
Route::get('/manage/basic/breed_code','\App\Admin\Controllers\farm\BasicController@breed_code');
Route::get('/manage/basic/barnmapindividual','\App\Admin\Controllers\farm\BasicController@barnmapindividual');
Route::get('/manage/basic/mateInput/outPregCattle','\App\Admin\Controllers\farm\BasicController@outPregCattle');
Route::post('/manage/basic/outpreg/semen_store','\App\Admin\Controllers\farm\BasicController@outpregSemenStore');
Route::post('/manage/basic/outpreg/mate_record_store','\App\Admin\Controllers\farm\BasicController@outPregMateRecordStore');
//牛舍牛只中间表
Route::post('/manage/basic/barnmapindividual/plusbarn_cattle','\App\Admin\Controllers\farm\BasicController@plusBarn_cattle');
//导入牛只信息
Route::post('/manage/basic/cattleinfo/import_cattle','\App\Admin\Controllers\farm\BasicController@import_cattle');
Route::get('/manage/basic/cattleinfo/lookrepeat','\App\Admin\Controllers\farm\BasicController@lookrepeat');//查询重复牛号
//删除重复牛只
Route::get('/manage/basic/cattleinfo/deleteRepeat/{id}','\App\Admin\Controllers\farm\BasicController@deleteRepeat');
Route::get('/manage/basic/barninfo','\App\Admin\Controllers\farm\BasicController@barninfo');
Route::post('/manage/basic/barninfo/addbarn','\App\Admin\Controllers\farm\BasicController@addbarn');
/*
**公牛信息
**查询结果
**详情页--pdf最终可打印可下载
**公牛系谱表
**导入公牛育种值
**导入公牛系谱
*/
Route::get('/manage/basic/sireinfos','\App\Admin\Controllers\farm\BasicController@sire');
Route::get('/manage/basic/sire/queryresult','\App\Admin\Controllers\farm\BasicController@sireQueryResult');
Route::get('/manage/basic/sire/siredetail/{sire_id}','\App\Admin\Controllers\farm\BasicController@sireDetail');
Route::post('/manage/basic/sire/import_sireInfo','\App\Admin\Controllers\farm\BasicController@importSireInfo');
Route::post('/manage/basic/sire/import_sirePedigree','\App\Admin\Controllers\farm\BasicController@importSirePedigree');

Route::get('/manage/basic/semen','\App\Admin\Controllers\farm\BasicController@semen');
//牛只详情页
Route::get('/manage/basic/single_cattle_detail/{cattle_id}','\App\Admin\Controllers\farm\BasicController@cattle_detail');
//牧场公牛库
Route::get('/manage/basic/cattle-pedigree','\App\Admin\Controllers\farm\BasicController@farmSireDepository');
Route::get('/manage/basic/cattlesire/query_sire_depository','\App\Admin\Controllers\farm\BasicController@query_sire_depository');
Route::post('/manage/basic/cattlesire/addnation','\App\Admin\Controllers\farm\BasicController@query_sire_depository');
Route::post('/manage/basic/cattlesire/addcompany','\App\Admin\Controllers\farm\BasicController@addcompany');
Route::post('/manage/basic/cattle_sire/sire_input','\App\Admin\Controllers\farm\BasicController@sire_input');
Route::get('/manage/basic/local_sire/detail/{sireId}','\App\Admin\Controllers\farm\BasicController@local_sire_detail');
// 外购母牛信息
Route::post('/manage/basic/cattle_dam/outDam/input_dam_info_pedigree','\App\Admin\Controllers\farm\BasicController@input_dam_info_pedigree');
// 冻精信息
Route::get('/manage/basic/semeninfos','\App\Admin\Controllers\farm\BasicController@semeninfos');
//繁育部分
Route::get('/manage/breed/mateInput','\App\Admin\Controllers\farm\BreedController@mateInput');
Route::post('/manage/breed/mate_record','\App\Admin\Controllers\farm\BreedController@mateRecordStore');

Route::post('/manage/breed/semen_broke_record','\App\Admin\Controllers\farm\BreedController@semen_broke_record');
Route::get('/manage/breed/yunjianinput','\App\Admin\Controllers\farm\BreedController@yunjianInput');
Route::post('/manage/breed/pregnancy_check_store','\App\Admin\Controllers\farm\BreedController@pregnancy_check_store');
Route::post('/manamge/breed/calv/calv_store','\App\Admin\Controllers\farm\BreedController@calv_store');
Route::get('/manage/breed/chandu','\App\Admin\Controllers\farm\BreedController@chandu');
Route::get('/manage/breed/aftercare','\App\Admin\Controllers\farm\BreedController@aftercare');
Route::post('/manage/breed/aftercare/store','\App\Admin\Controllers\farm\BreedController@after_care_store');
Route::get('/manage/breed/mateplan','\App\Admin\Controllers\farm\BreedController@mateplan');
Route::post('/manage/breed/mateplan/month','\App\Admin\Controllers\farm\BreedController@ajaxQueryMonth');
Route::get('/manage/breed/mateplan/yearly','\App\Admin\Controllers\farm\BreedController@mateplan_yearly');
Route::get('/manage/breed/waitmate','\App\Admin\Controllers\farm\BreedController@waitmate');
Route::get('/manage/breed/fanzhidisease','\App\Admin\Controllers\farm\BreedController@fanzhidisease');
Route::post('/manage/breed/disease/store','\App\Admin\Controllers\farm\BreedController@breed_disease_store');
Route::post('/manage/breed/disease/update','\App\Admin\Controllers\farm\BreedController@breed_disease_update');
Route::get('/manage/breed/expected_birth','\App\Admin\Controllers\farm\BreedController@expected_birth');
Route::get('/manage/breed/matereport/month','\App\Admin\Controllers\farm\BreedController@month_report');
Route::get('/manage/breed/matereport/yearly','\App\Admin\Controllers\farm\BreedController@yearly_report');

//兽医登记部分
Route::get('/manage/Veterinary/disease_input','\App\Admin\Controllers\farm\VeterController@disease_input');
Route::post('/manage/Veterinary/disease_input','\App\Admin\Controllers\farm\VeterController@disease_input_store');
Route::get('/manage/Veterinary/diseasing_list','\App\Admin\Controllers\farm\VeterController@diseasing_list');
Route::get('/manage/Veterinary/diseasing/daily_update/{id}','\App\Admin\Controllers\farm\VeterController@diseasing_daily_update');
Route::post('/manage/Veterinary/diseasing/daily_update/{id}','\App\Admin\Controllers\farm\VeterController@diseasing_daily_store');

Route::get('/manage/Veterinary/antiepidemic_batch','\App\Admin\Controllers\farm\VeterController@antiepidemic_batch');
Route::get('/manage/Veterinary/antiepidemic_single','\App\Admin\Controllers\farm\VeterController@antiepidemic_single');
Route::get('/manage/Veterinary/antiepidemic_history','\App\Admin\Controllers\farm\VeterController@antiepidemic_history');
Route::post('/manage/Veterinary/get_barn_cattle_num','\App\Admin\Controllers\farm\VeterController@get_barn_cattle_num');
Route::post('/manage/Veterinary/antiepidemic/store','\App\Admin\Controllers\farm\VeterController@antiepidemic_store');
Route::get('/manage/Veterinary/epidemic/plus_type','\App\Admin\Controllers\farm\VeterController@plus_epidemic_type');

Route::get('/manage/Veterinary/Quarantine_input','\App\Admin\Controllers\farm\VeterController@Quarantine_input');
Route::get('/manage/Veterinary/Quarantine_history','\App\Admin\Controllers\farm\VeterController@Quarantine_history');
Route::post('/manage/Veterinary/Quarantine_store','\App\Admin\Controllers\farm\VeterController@Quarantine_store');

Route::get('/manage/Veterinary/trim_hoof_input','\App\Admin\Controllers\farm\VeterController@trim_hoof_input');
Route::get('/manage/Veterinary/trim_hoof_history','\App\Admin\Controllers\farm\VeterController@trim_hoof_history');
Route::post('/manage/Veterinary/trim_hoof/store','\App\Admin\Controllers\farm\VeterController@trim_hoof_store');

Route::get('/manage/Veterinary/repellent_single','\App\Admin\Controllers\farm\VeterController@repellent_single');
Route::get('/manage/Veterinary/repellent_batch','\App\Admin\Controllers\farm\VeterController@repellent_batch');
Route::get('/manage/Veterinary/repellent_history','\App\Admin\Controllers\farm\VeterController@repellent_history');
Route::get('/manage/Veterinary/disinfection_input','\App\Admin\Controllers\farm\VeterController@disinfection_input');
Route::get('/manage/Veterinary/disinfection_history','\App\Admin\Controllers\farm\VeterController@disinfection_history');
// 兽医记录查看

//饲养管理
Route::get('/manage/feed/dieOut','\App\Admin\Controllers\farm\FeedController@dieOut');
Route::post('/manage/feed/dieOut','\App\Admin\Controllers\farm\FeedController@dieOut_store');
Route::get('/manage/feed/sell_batch','\App\Admin\Controllers\farm\FeedController@sell_batch');
Route::post('/manage/feed/sell_batch','\App\Admin\Controllers\farm\FeedController@sell_batch_store');
Route::get('/manage/feed/change_barn','\App\Admin\Controllers\farm\FeedController@change_barn');
Route::post('/manage/feed/getBarnNum','\App\Admin\Controllers\farm\FeedController@getBarnNum');
Route::post('/manage/feed/check_cattle','\App\Admin\Controllers\farm\FeedController@check_cattle');

// 饲养管理信息展示查询
Route::get('/manage/feed/eliminate_ledger','\App\Admin\Controllers\farm\ProductController@eliminate_ledger');
Route::get('manage/feed/eliminate_ledger/accordCattle','\App\Admin\Controllers\farm\ProductController@eliminate_ledger_accord_cattle');
Route::get('/manage/feed/eliminate/elimiOrder/{order}','\App\Admin\Controllers\farm\ProductController@batch_detail');
Route::get('/manage/feed/sell_ledger','\App\Admin\Controllers\farm\ProductController@sell_ledger');
Route::get('/manage/feed/sell_ledger/accordCattle','\App\Admin\Controllers\farm\ProductController@sell_ledger_accord_cattle');
Route::get('/manage/feed/sell/sellBatchOrder/{order}','\App\Admin\Controllers\farm\ProductController@sell_batch_detail');
Route::get('/manage/feed/change_barn_history','\App\Admin\Controllers\farm\ProductController@change_barn_history');
//饲养之转舍
Route::post('/manage/feed/cattle_barn/returnAssociate','\App\Admin\Controllers\farm\FeedController@returnAssociate');
Route::post('/manage/feed/cattle_barn/getbarnCattle','\App\Admin\Controllers\farm\FeedController@getbarnCattle');
Route::post('/manage/feed/cattle_barn/insertChangeBarn','\App\Admin\Controllers\farm\FeedController@insertChangeBarn');
Route::post('/manage/feed/cattle_barn/changebar/wholeMigration','\App\Admin\Controllers\farm\FeedController@wholeMigration');
// 供货商管理
Route::get('/manage/supplier/plus','\App\Admin\Controllers\farm\SupplierController@supplier_plus');
Route::get('/manage/supplier/info','\App\Admin\Controllers\farm\SupplierController@supplier_info');
Route::get('/manage/supplier/contacter/plus','\App\Admin\Controllers\farm\SupplierController@supplier_contacter_plus');
Route::post('/manage/supplier/contacter/plus','\App\Admin\Controllers\farm\SupplierController@supplier_contacter_store');
Route::post('/manage/supplier/plus','\App\Admin\Controllers\farm\SupplierController@supplier_plus_store');
Route::get('/manage/supplier/detail/{id}','\App\Admin\Controllers\farm\SupplierController@supplier_detail');
Route::post('/manage/supplier/update/license','\App\Admin\Controllers\farm\SupplierController@supplier_update_license');
Route::get('/manage/supplier/forbidden/{id}','\App\Admin\Controllers\farm\SupplierController@supplier_forbidden');
Route::post('/manage/supplier/get_company','\App\Admin\Controllers\farm\SupplierController@get_company');
//物资管理
// 饲料和器材耗材使用新controller,不然整个物资controller太大了。
//*.药品。*
Route::get('/manage/material/drugs/repository','\App\Admin\Controllers\farm\materialController@drugs_repository');
Route::get('/manage/material/drugs/repository/plus','\App\Admin\Controllers\farm\materialController@drugs_repository_plus');
Route::post('/manage/material/drugs/repository/store','\App\Admin\Controllers\farm\materialController@drugs_repository_store');
Route::get('/manage/material/drugs/repo/detail/{id}','\App\Admin\Controllers\farm\materialController@repo_detail');
Route::get('/manage/material/drugs/input','\App\Admin\Controllers\farm\materialController@drugs_input');
Route::post('/manage/material/drugs/input','\App\Admin\Controllers\farm\materialController@drugs_input_store');
Route::get('/manage/material/drugs/ledger/store','\App\Admin\Controllers\farm\materialController@drugs_store_ledger');
Route::get('/manage/material/drugs/ledger/output','\App\Admin\Controllers\farm\materialController@drugs_output_ledger');
Route::get('/manage/material/drugs/output','\App\Admin\Controllers\farm\materialController@drugs_output');
Route::post('/manage/material/drugs/output/store','\App\Admin\Controllers\farm\materialController@drugs_output_store');
Route::get('/manage/material/drugs/remain','\App\Admin\Controllers\farm\materialController@drugs_remain');
Route::post('/manage/material/drugs/get_drug_info','\App\Admin\Controllers\farm\materialController@get_drug_info');
Route::post('/manage/material/drugs/get_drug_remain','\App\Admin\Controllers\farm\materialController@get_drug_remain');
// 查询药品库存不为零的批次
Route::post('/manage/material/drugs/store_drug_record','\App\Admin\Controllers\farm\materialController@store_drug_record');

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
Route::get('/manage/material/semen_input','\App\Admin\Controllers\farm\materialController@semen_input');
Route::post('/manage/material/semen_input','\App\Admin\Controllers\farm\materialController@semen_store');
Route::get('/manage/material/semen_output','\App\Admin\Controllers\farm\materialController@semen_output');
Route::post('/manage/material/semen_output','\App\Admin\Controllers\farm\materialController@semen_output_store');
//冻精入库明细
Route::get('/manage/material/semen/store_ledger','\App\Admin\Controllers\farm\materialController@semen_store_ledger');
Route::get('/manage/material/semen_remain','\App\Admin\Controllers\farm\materialController@semen_remain');
// 冻精出库明细，损坏明细
Route::get('/manage/material/semen/out_ledger','\App\Admin\Controllers\farm\materialController@semen_out_ledger');
Route::get('/manage/material/semen/broke_ledger','\App\Admin\Controllers\farm\materialController@semen_broke_ledger');
// 冻精使用明细
Route::get('/manage/breed/mate_ledger','\App\Admin\Controllers\farm\materialController@mate_ledger');
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
Route::post('/manage/staff/offWork/store','\App\Admin\Controllers\farm\StaffController@offWorkStore');
Route::post('/manage/staff/offwork/update','\App\Admin\Controllers\farm\StaffController@offWorkUpdate');
Route::get('/manage/staff/offwork/delete/{id}','\App\Admin\Controllers\farm\StaffController@offWorkdelete');
//员工--考勤
Route::get('/manage/staff/attendance','\App\Admin\Controllers\farm\StaffController@attendance');
Route::post('/manage/staff/uploadattendance','\App\Admin\Controllers\farm\StaffController@uploadattendance');
Route::get('/manage/staff/delete_attendance/{id}','\App\Admin\Controllers\farm\StaffController@attendance_delete');
//员工--临时工
Route::get('/manage/staff/tmpworker','\App\Admin\Controllers\farm\StaffController@tmpworker_list');
Route::post('/manage/staff/add_tmpworker','\App\Admin\Controllers\farm\StaffController@add_tmpworker');
Route::get('/manage/staff/delete_tmpworker/{id}','\App\Admin\Controllers\farm\StaffController@delete_tmpworker');
Route::post('/manage/staff/update_tmpworker','\App\Admin\Controllers\farm\StaffController@update_tmpworker');
Route::post('/manage/staff/uploadCode','\App\Admin\Controllers\farm\StaffController@importcode');
// 员工--设置部门，职位
Route::get('/manage/staff/map_s_d','\App\Admin\Controllers\farm\StaffController@map_s_d');
Route::post('/manage/staff/stroe_map_s_d','\App\Admin\Controllers\farm\StaffController@stroe_map_s_d');
// ajax获取员工信息
Route::post('/manage/staff/get_staff','\App\Admin\Controllers\farm\StaffController@get_staff');
//车辆管理
Route::get('/manage/car','\App\Admin\Controllers\car\CarController@index');
Route::post('/manage/car/add_car','\App\Admin\Controllers\car\CarController@add_car');
Route::post('/manage/car/car_update','\App\Admin\Controllers\car\CarController@car_update');
Route::get('/manage/car/delete/{id}','\App\Admin\Controllers\car\CarController@car_delete');
//出车记录--
Route::get('/manage/car/regiout','\App\Admin\Controllers\car\CarController@regiout');
Route::post('/manage/car/regiout/regiout_add','\App\Admin\Controllers\car\CarController@regiout_add');
Route::get('/manage/car/regiout/delete/{id}','\App\Admin\Controllers\car\CarController@regiout_delete');
Route::post('/manage/car/regiout/update','\App\Admin\Controllers\car\CarController@regiout_update');
//回车记录
Route::get('/manage/car/regireturn','\App\Admin\Controllers\car\CarController@regireturn');
Route::post('/manage/car/regireturn_add','\App\Admin\Controllers\car\CarController@regireturn_add');
Route::post('/manage/car/regireturn_update','\App\Admin\Controllers\car\CarController@regireturn_update');
//油卡记录
Route::get('/manage/car/oilrecord','\App\Admin\Controllers\car\CarController@oilrecord');
Route::post('/manage/car/oilcard_add','\App\Admin\Controllers\car\CarController@oilcard_add');
Route::get('/manage/car/oilcard','\App\Admin\Controllers\car\CarController@oilcard');
Route::post('/manage/car/cardrecharge','\App\Admin\Controllers\car\CarController@cardrecharge');
Route::get('/manage/car/oilcard/recharge','\App\Admin\Controllers\car\CarController@recharge_detail');
//保养记录
Route::get('/manage/car/maintainace','\App\Admin\Controllers\car\CarController@maintain');
Route::post('/manage/car/maintain/add','\App\Admin\Controllers\car\CarController@maintain_add');
Route::post('/manage/car/maintain/update','\App\Admin\Controllers\car\CarController@maintain_update');
Route::get('/manage/car/maintain/delete/{id}','\App\Admin\Controllers\car\CarController@maintain_delete');
//维修记录
Route::get('/manage/car/repair','\App\Admin\Controllers\car\CarController@repair');
Route::post('/manage/car/repair/add','\App\Admin\Controllers\car\CarController@repair_add');
Route::post('/manage/car/repair/update','\App\Admin\Controllers\car\CarController@repair_update');

//肉牛生产性能测定 
Route::get('/manage/performance/growth','\App\Admin\Controllers\farm\PerformanceController@index');
Route::get('/manage/performance/fatten','\App\Admin\Controllers\farm\PerformanceController@fatten');
Route::get('/manage/performance/feed_conversion','\App\Admin\Controllers\farm\PerformanceController@feed_conversion');
Route::get('/manage/performance/carcass','\App\Admin\Controllers\farm\PerformanceController@carcass');
Route::get('/manage/performance/meat_quality','\App\Admin\Controllers\farm\PerformanceController@meat_quality');
Route::get('/manage/performance/meat_quality','\App\Admin\Controllers\farm\PerformanceController@meat_quality');
Route::get('/manage/performance/report','\App\Admin\Controllers\farm\PerformanceController@report');
Route::get('/manage/performance/query&update','\App\Admin\Controllers\farm\PerformanceController@queryUpdate');
    //饲料转化部分
Route::post('/manage/performance/feed_conversion/plusexperiment','\App\Admin\Controllers\farm\PerformanceController@plusexperiment');
Route::post('/manage/performance/feed_conversion/updateExperiment','\App\Admin\Controllers\farm\PerformanceController@updateExperiment');
Route::get('/manage/performance/feed_conversion/deleteExperiment/{id}','\App\Admin\Controllers\farm\PerformanceController@deleteExperiment');
Route::get('/manage/performance/feed_conversion/addStartWeight/{id}','\App\Admin\Controllers\farm\PerformanceController@addStartWeight');
Route::get('/manage/performance/feed_conversion/addEndWeight/{id}','\App\Admin\Controllers\farm\PerformanceController@addEndWeight');
Route::post('/manage/performance/feed_conversion/plusStartWeight/{id}','\App\Admin\Controllers\farm\PerformanceController@plusStartWeight');
Route::post('/manage/performance/feed_conversion/plusEndWeight/{id}','\App\Admin\Controllers\farm\PerformanceController@plusEndWeight');
Route::post('/manage/performance/feed_conversion/importStartWeight','\App\Admin\Controllers\farm\PerformanceController@importStartWeight');
Route::get('/manage/performance/feed_conversion/experi/{id}','\App\Admin\Controllers\farm\PerformanceController@convertDetail');
Route::post('/manage/performance/feed_conversion/experi/feedRecord_add','\App\Admin\Controllers\farm\PerformanceController@feedRecord_add');
Route::get('/manage/performance/feed_conversion/experi_done/{id}','\App\Admin\Controllers\farm\PerformanceController@experi_done_display');
Route::get('/manage/performance/feed_conversion/experi_done/{id}/feeding_details','\App\Admin\Controllers\farm\PerformanceController@feeding_details');
//ajax检测饲料表是否有记录
Route::post('/manage/performance/feed_conversion/experi/checkfeedrecord','\App\Admin\Controllers\farm\PerformanceController@checkFeedRecord');
Route::post('/manage/performance/feed_conversion/closeExperiment','\App\Admin\Controllers\farm\PerformanceController@closeExperiment');
//生长发育性状部分
Route::post('/manage/performance/growth/plusRecord','\App\Admin\Controllers\farm\PerformanceController@plusRecord');








});



//admin结束

});

