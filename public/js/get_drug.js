$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#drug_name").keyup(delay(function(){
    var name= $("#drug_name").val()
    var store= $("#inOrOut").val()
    $("#supplier_back").hide();
            // 清空批次信息 drug_stored_id上次返回的信息
            $("#drug_stored_id").find("option").not(":first").remove()

    get_drug(name,store)
},100))
$("#drug_info").change(function(){
  var drug_name = $("#drug_info option:selected").text()
  var drug_id = $("#drug_info option:selected").val()
//   拆分数组
    var n = drug_name.split('，')
  $("#drug_name").val(n[0])
  $("#Supplier").val(n[1])
        if(n[2] == '1'){
            $("#drugType").val('治疗类')
        }else if(n[2] == '2'){
            $("#drugType").val('输液类')
        }else if(n[2] == '3'){
            $("#drugType").val('消毒剂')
        }else if(n[2] == '4'){
            $("#drugType").val('疫苗')
        }else{
            $("#drugType").val('检疫类')
        }
        $("#unit").html('/'+n[3])
        $("#drug_id").val(drug_id)
        // get_drug_remain(drug_id)
  // alert(drug_id)
        $("#drug_info").hide()


        // 同时查询药品库存不为0的进货批次，
        store_drug_record(drug_id)
})
// 计算保质期结束时间
$("#retention_period").keyup(delay(function(){
    var startdate = $("#date_of_manufacture").val()
    if(startdate != '' && startdate != 0 && startdate != null ){
      addDate()
    }
},300))
$("#date_of_manufacture").keyup(delay(function(){
  addDate()
},300))
$("#date_of_manufacture").on('change',function(){
  var retention = $("#retention_period").val()
  if(retention != '' && retention != 0 && retention != null ){
    addDate()
  }
})
$('body').on('change','#drug_stored_id',function(){
  var drug_id = $("#drug_id").val()
  var drug_store_id = $(this).val()
  get_drug_remain(drug_id,drug_store_id)
})

function get_drug(drug_name,type){
  $.ajax({
    type:'post',
    url:'/admin/manage/material/drugs/get_drug_info',
    dataType:"json",
    data:{'drug_name':drug_name,'type':type},
    success: function(msg){
      $("#drug_info").empty()
      $("#drug_info").show();
      var obj=msg.drug_name
      if(obj.length == 0){
        $("#drug_info").hide();
        $("#drug_back").show();
      }else{
        for(var i=0;i<obj.length;i++){
          var item=obj[i];
          $("#drug_info").append("<option value="+item['id']+">"+item['drugName']+'，'+item['supplier']+'，'+item['drugType']+'，'+item['unit']+"</option>");
        }
      }
          }
        }
      )
}
function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }
//   计算时间加减函数
function addDate(){
  var startdate = $("#date_of_manufacture").val()
  var start = new Date(startdate).getTime()
  var plusday = $("#retention_period").val()
  var expireday = start +plusday*24*60*60*1000
  var thatday = new Date(expireday)
  y = thatday.getFullYear()
  m = thatday.getMonth()+1
  d = thatday.getDate()
  if(m < 10){
    m = '0' +m
  }
  if(d < 10){
    d = '0' +d
  }
  var endDate = y +'-'+m+'-'+d
  // 月份如果是单数，前面要补0，否则报错
  if(plusday < 10000000){
  $("#expire_date").val(endDate)
  }else {
  alert('保质期过长，可能是个错误')
  }
}
// 获取药品库存
function get_drug_remain(drug_id,drug_store_id)
{
  $.ajax({
    type:'post',
    url:'/admin/manage/material/drugs/get_drug_remain',
    dataType:"json",
    data:{'drug_id':drug_id,'drug_store_id':drug_store_id},
    success: function(msg){
     $(".drug-feed-back").html('剩余库存数量是'+msg)
     $(".drug-feed-back").show()
        }
      })
  }
  function store_drug_record(drug_id)
  {
    $.ajax({
      type:'post',
      url:'/admin/manage/material/drugs/store_drug_record',
      dataType:"json",
      data:{'drug_id':drug_id},
      success: function(msg){
        var obj = msg.batchs
          for(var i=0;i<obj.length;i++){
            var item=obj[i];
            $("#drug_stored_id").append("<option value="+item['id']+">批次："+item['batch_order']+'，日期：'+item['storedDay']+'，价格'+item['price']+"</option>");
          }
        }

        })
  }
