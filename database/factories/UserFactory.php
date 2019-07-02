<?php

use Faker\Generator as Faker;
use App\Models\Regioncode;
use App\Models\Caroutregi;
use App\Models\Carinfo;
use App\Model\Nation;


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

// $factory->define(App\User::class, function (Faker $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//         'remember_token' => str_random(10),
//     ];
// });
//文章表填充数据
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(10),
        'admin_user_id' =>'1',
        'posttype_id' => $faker->randomElement($array = array('1','2','3','4')),
        'lunboLink' =>$faker->randomElement($array = array ('https://placeimg.com/480/320/any','https://placeimg.com/480/320/nature','https://placeimg.com/480/320/beauty')),
        'lunboTitle' =>$faker->word,
        'lunboCaption' =>$faker->sentence(3),

    ];
});
//公告通知填充数据
$factory->define(App\Bulletin::class, function (Faker $faker) {
  return [
    'bulletinPhoto'=>'https://placeimg.com/480/320/any',
    'bulletinTitle'=>'春季防疫',
    'bulletinContent'=>'1、无论注射任何疫苗，为确保疫苗危害最小，必须先选出10-20头做注射疫苗试验，试验安全后再进行全群注射。 2、公司将根据疫苗流行情况和防控需要，开展疫苗免疫、检疫项目。各牧场应按照公司防疫相关部门制定的年度免疫及检疫计划，实施牛群免疫、检疫工作。 3、免疫注射过程中，由专人负责疫苗领取并全程负责疫苗分配使用。',
  ];
});
//区域代码
$factory->define(App\Models\Regioncode::class, function (Faker $faker) {
  return [
    'regioncode'=>$faker->randomElement($array=array('410105','410184','410202','410301','410322')),
    'divisions'=>$faker->randomElement($array=array('郑州市金水区','郑州市新郑市','开封市辖区','洛阳市辖区','洛阳市孟津县')),
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
      'Pid'=>$faker->numberBetween($min = 0, $max = 5),
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
//车辆信息模型
$factory->define(App\Models\Carinfo::class, function (Faker $faker) {
    return [
      'licensePlate' =>'豫'.$faker->randomElement($array = array ('A','B','C')).$faker->numberBetween($min = 12000, $max = 99996),
      'carBrand'=>$faker->randomElement($array = array ('大众','起亚','丰田','奥迪','宝马','本田','福特','现代','标致','奔驰','别克','长安','日产','长城')),
      'Vtype' => $faker->word.$faker->numberBetween($min=100000,$max=999999),
      'Vcategory'=>$faker->randomElement($array=array('轿车','SUV','摩托车','货车','叉车','清粪车')),
      'color' =>$faker->colorName,
      'seatNumber' =>$faker->numberBetween($min=2,$max=9),
      'EngineNumber'=>$faker->numberBetween($min=10000,$max=99999),
      'frameNumber'=>$faker->uuid,

  ];
});
//车辆出车登记
$factory->define(App\Models\Caroutregi::class, function (Faker $faker) {
  return [
    'licensePlate' =>'豫'.$faker->randomElement($array = array ('A','B','C')).$faker->numberBetween($min = 12000, $max = 99996),
    'Vuser'=>$faker->name,
    'outtime' => $faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'driver'=>$faker->name,
    'destination' =>$faker->city,
    'forwhat' =>$faker->randomElement($array = array ('畜牧局开会','合作社服务','小额贷','出差联系买牛业务')),
    'estimatedreturn'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'outMileage'=>$faker->numberBetween($min = 50, $max = 2000000),
    'note'=>$faker->sentence,

];
});
//车辆回车登记
$factory->define(App\Models\Carreturn::class, function (Faker $faker) {
  $plates=Caroutregi::get(['licensePlate'])->toArray();
  $plate =  array_column($plates, 'licensePlate');
  return [
    'licensePlate' =>$faker->randomElement($plate),
    'Vuser'=>$faker->name,
    'returnTime' => $faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'returnMileage'=>$faker->numberBetween($min = 1500,$max = 20000),
    'note'=>$faker->sentence,

];
});
//加油记录
$factory->define(App\Models\Oilrecord::class, function (Faker $faker) {
  $plates=Carinfo::get(['licensePlate'])->toArray();
  $plate =  array_column($plates, 'licensePlate');
  return [
    'licensePlate' =>$faker->randomElement($plate),
    'refueling_time'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'station' => $faker->randomElement($array = array('伊川县豫港大道','鸣皋镇国道旁中国石化','洛阳市高铁站中国石化')),
    'cardID'=>$faker->randomElement($array = array ('8000 0000 0652 7431','9000 0000 0312 8311','2316 0000 0312 1560')),
    'oiltype'=>$faker->randomElement($array = array ('92#','95#','97#','柴油')),
    'amount'=>$faker->randomElement($array = array ('100','200','300','400')),
    'mileage'=>$faker->numberBetween($min = 50, $max = 2000000),
];
});
//保养记录
$factory->define(App\Models\Carmaintain::class, function (Faker $faker) {
  $plates=Carinfo::get(['licensePlate'])->toArray();
  $plate =  array_column($plates, 'licensePlate');
  return [
    'licensePlate' =>$faker->randomElement($plate),
    'maintain_day'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'pic' => $faker->randomElement($array = array('洪飞','小段','宝宝')),
    'repair_plant'=>$faker->randomElement($array = array ('莱邦汽修','尊驰修理厂','小李汽修')),
    'mileage'=>$faker->numberBetween($min = 50, $max = 2000000),
    'cost'=>$faker->randomElement($array=array('140','180','200','240','320','500','1000')),
];
});
//维修记录
$factory->define(App\Models\Carrepair::class, function (Faker $faker) {
  $plates=Carinfo::get(['licensePlate'])->toArray();
  $plate =  array_column($plates, 'licensePlate');
  return [
    'licensePlate' =>$faker->randomElement($plate),
    'send_date'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'reason'=>$faker->randomElement($array=array('右前门扳金喷漆','发动机报警','导航音响维修')),
    'pic' => $faker->randomElement($array = array('洪飞','小段','宝宝')),
    'repair_plant'=>$faker->randomElement($array = array ('莱邦汽修','尊驰修理厂','小李汽修')),
    'back_date'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'mileage'=>$faker->numberBetween($min = 50, $max = 2000000),
    'cost'=>$faker->randomElement($array=array('140','180','200','240','320','500','1000')),
];
});
//牛只信息
$factory->define(App\Models\Cattle::class, function (Faker $faker) {
  static $i=1;
  return [
    'cattleID' =>'1805612'.$i++,
    'birthday'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'birthWeight'=>$faker->numberBetween($min = 20, $max = 40),
    'gender' => $faker->randomElement($array = array('公','母')),
    'whichBreed'=>$faker->randomElement($array = array ('1','2','3','4','5','6')),
    'whereComefrom'=>$faker->randomElement($array = array ('自繁','宁夏固原','天津雄特','甘肃饮马','内蒙古','东北')),
    'enterDay'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = '-6 month',$timezone = 'PRC'),
    'enterWeight'=>$faker->numberBetween($min = 260, $max = 400),
    'pregnancyNum'=>$faker->randomElement($array=array('0','1','2','3','4','5')),
     'status'=>$faker->randomElement($array=array('在群','不在群')),
];
});
//牛舍信息
$factory->define(App\Models\CattleBarn::class, function (Faker $faker) {
  static $order = 1; 
  return [
    'barnID' =>$order++ ,
    'barnName'=>$faker->randomElement($array=array('母子舍','犊牛舍','育成公牛','育成母牛','怀孕母牛','围产牛','育肥牛')),
    'barnStyle'=>$faker->randomElement($array=array('开放式','封闭式','半开放式')),
    'groundStyle'=>$faker->randomElement($array=array('水泥地面','砖混','泥沙土','三合土')),
    'acreage'=>$faker->numberBetween($min = 500, $max = 2000),
    'checkClipNum'=>$faker->numberBetween($min=20,$max=200),
    'waterTrough'=>$faker->numberBetween($min=1,$max=6),
    'troughSize'=>$faker->numberBetween($min=300,$max=800),
    'PIC'=>$faker->randomElement($array=array('1','2','3','4','5','6')),
    'description'=>$faker->randomElement($array=array('200-300kg','适配期育成','','待出栏')),

  ];

 
});
//模拟国内外种公牛站公牛信息
$factory->define(App\Models\CattleSireInfo::class, function (Faker $faker) {
  static $order = 1; 
  $sireRegi=$faker->randomElement($array=array('411','412','131','133','141','152','155')).$faker->numberBetween($min=01,$max=99).$faker->numberBetween($min=111,$max=999);
  $nations=Nation::get(['abbreviation'])->toArray();
  $nations=array_column($nations,'abbreviation');
  
  return [
    'sireRegi' =>$sireRegi,
    'semenNum'=>$sireRegi,
    'breedType'=>$faker->randomElement($array=array('安格斯','西门塔尔','夏洛来','利木赞')),
    'nation'=>$faker->randomElement($nations),
    'belongToCompany'=>$faker->randomElement($array=array('河南省鼎元种牛育种有限公司','许昌市畜牧技术推广站','河北省畜牧良种工作站','山西省家畜冷冻精液中心','通辽京缘种牛繁育有限责任公司','内蒙古赛克星生物技术股份有限公司')),
    'birthDay'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'CBI'=>$faker->numberBetween($min=140,$max=450),
    'BW'=>$faker->numberBetween($min=20,$max=45),
    'WW'=>$faker->numberBetween($min=100,$max=200),
    'YW'=>$faker->numberBetween($min=300,$max=400),
    'W18month'=>$faker->numberBetween($min=500,$max=600),
    'W24month'=>$faker->numberBetween($min=650,$max=750),
    'W36month'=>$faker->numberBetween($min=760,$max=830),
    'level'=>$faker->randomElement($array=array('特','优','良','中','一般')),
    'CEM'=>$faker->numberBetween($min=-10,$max=50),
    'milk'=>$faker->numberBetween($min=-10,$max=50),
    'MH'=>$faker->numberBetween($min=120,$max=180),
    'MW'=>$faker->numberBetween($min=600,$max=800),
    'CW'=>$faker->numberBetween($min=-20,$max=50),
    'Marbling'=>$faker->numberBetween($min=-10,$max=50),
    'REA'=>$faker->numberBetween($min=-10,$max=50),
    'Fat'=>$faker->numberBetween($min=-10,$max=50),
    '$F'=>$faker->numberBetween($min=100,$max=500),
    '$G'=>$faker->numberBetween($min=200,$max=500),
    '$QG'=>$faker->numberBetween($min=100,$max=500),
    '$YG'=>$faker->numberBetween($min=100,$max=500),
    '$B'=>$faker->numberBetween($min=100,$max=500),

  ];

 
});

//冻精出库记录
$factory->define(App\Models\SemenOutRecord::class, function (Faker $faker) {
 
  return [
    'semen_id' =>$faker->randomElement($array=array('1','2','3','4')),
    'outDay'=>$faker->dateTimeBetween($startDate = '-30 month',$endDate = 'now',$timezone = 'PRC'),
    'amount'=>$faker->numberBetween($min=100,$max=500),
    'PIC'=>$faker->randomElement($array=array('zhangsan','lisi','wangwu','zhaoliu')),
    'user'=>$faker->randomElement($array=array('zhangsan','lisi','wangwu','zhaoliu')),

  ];

 
});