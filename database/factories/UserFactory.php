<?php

use Faker\Generator as Faker;
use App\Models\Regioncode;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
//文章表填充数据
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(10),
        'admin_user_id' =>$faker->randomDigit,
        'posttype_id' => $faker->randomDigit,
        'lunboLink' =>$faker->imageUrl($width = 320, $height = 200),
        'lunboTitle' =>$faker->word,
        'lunboCaption' =>$faker->sentence(3),

    ];
});
//员工表填充数据
$factory->define(App\Models\Staff::class, function (Faker $faker) {
    
      return [
        'name' =>$faker->name,
        'gender'=>$faker->randomElement($array = array ('男','女')),
        'telephone' =>$faker->PhoneNumber(),
        'birthday' => $faker->dateTimeBetween($startDate = '-30 years',$endDate = 'now',$timezone = 'PRC'),
        'entryDate' =>$faker->dateTimeBetween($startDate = '-3 years',$endDate = 'now'),
        'eduDegree' =>$faker->randomElement($array = array ('小学','初中','高中','大专','本科','硕士','博士')),
        'school' => $faker->randomElement($array = array ('河南科技大学','洛阳理工','西北农林','北京大学','清华大学','郑州大学','郑州牧专')),
        'major'=>$faker->randomElement($array = array ('动物科学','兽医','机械工程','机电一体化','繁殖育种')),     
        'gradudate'=>$faker->dateTimeBetween($startDate = '-20 years',$endDate = 'now'),
        'special'=>$faker->randomElement($array = array ('摄影','篮球','乒乓球','象棋','看书')),
        'Political_status'=>$faker->randomElement($array = array ('党员','团员','群众','民盟','致公党')),
    ];
});


//请假条填充数据 
$factory->define(App\Models\Offwork::class, function (Faker $faker) {
    return [
      'name' =>$faker->name,
      'Reason'=>$faker->sentence($nbWords = 10, $variableNbWords = true),
      'startTime' => $faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
      'endTime' =>$faker->dateTimeBetween($startDate = '-20 month',$endDate = 'now',$timezone = 'PRC'),
      'offType' =>$faker->randomElement($array = array ('病假','事假','婚假','年假')),
      'leaderApproval' => $faker->randomElement($array = array ('同意','不同意')),
      'returnTime'=>$faker->dateTimeBetween($startDate = '-20 month',$endDate = 'now',$timezone = 'PRC'),    
      'fill_form_by'=>'chentao111',
  ];
});



//部门管理填充数据
$factory->define(App\Models\Department::class, function (Faker $faker) {
    return [
      'departName' =>$faker->randomElement($array = array ('管理部','生产部','办公室','财务部','人力资源部','安保组','技术组','兽医','繁育')),
      'Pid'=>$faker->numberBetween($min = 0, $max = 9),
      'departIntro' => $faker->sentence,

  ];
});
//临时用工填充数据
$factory->define(App\Models\Tempworker::class, function (Faker $faker) {
    $regioncodes=Regioncode::get(['regioncode'])->toArray();
    $region =  array_column($regioncodes, 'regioncode');
    return [
      'name' =>$faker->name,
      'gender'=>$faker->randomElement($array = array ('男','女')),
      'mobilePhone' => $faker->PhoneNumber(),
      'personid'=>$faker->randomElement($region).$faker->date($format = 'Ymd', $min='-18 years', $max = '-60 years').$faker->randomDigit.$faker->randomDigit.$faker->randomNumber($nbDigits = 2, $strict = true),
      'startDay' =>$faker->dateTimeBetween($startDate = '-3 years',$endDate = 'now'),
      'endDay' =>$faker->dateTimeBetween($startDate = '-3 years',$endDate = 'now'),
      'workContent'=>$faker->sentence,
      'dailySalary'=>$faker->numberBetween($min = 50, $max = 200),
      'totalSalary'=>$faker->numberBetween($min = 200, $max = 1000),
      'payStatus'=>$faker->randomElement($array = array ('已付','未付','因故取消')),
      'payDate'=>$faker->dateTimeBetween($startDate = '-3 years',$endDate = 'now'),
      'note'=>$faker->word,
      'fill_form_by'=>'chentao123',
  ];
});