$('#cattleID').keyup(delay(function (e) {
    var cattleID = this.value
   checkCattle(cattleID)
 }, 1000));
$("#cattleID").off("paste").on("paste",delay(function(e){
        var paste = e.originalEvent.clipboardData.getData('Text');
        var arr = paste.split(',')
        checkCattle(paste)
    },1000));
$("#status2").click(function(){
$("#treatmentResult").removeAttr('hidden')
$("#dailyResult").attr("hidden",true)
})
$("#status1").click(function(){
$("#treatmentResult").attr("hidden",true)
$("#dailyResult").removeAttr("hidden")

})
// 点击事件不行，当点击其它的时候会消失，必须使用选中事件
$(":checkbox").click(function(){
if($('#therap1').is(':checked') || $('#therap2').is(':checked') ){
  $('#selectDrug').removeAttr('hidden')
}else{
  $('#selectDrug').attr('hidden',true)
}
})
// 这里左前使用默认的，右前，左后，右后，在trim_hoof_input.js里设定
$("body").on('click',".plusDrug",function(){
 var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="drugUse[]" id="drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text input_unit">ml</div></div></div></div> <div class="col-sm-1 plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">继续添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
$("#selectDrug").append(html);
$(this).hide()
$(this).next().hide()
})
$("body").on('click','.minusDrug',function(){
$(this).prev().prev().prev().prev().prev().show()
$(this).prev().prev().prev().prev().show()
$(this).prev().prev().prev().remove()
$(this).prev().prev().remove()
$(this).prev().remove()
$(this).remove()

})
$("body").on('keyup','.get_drug_info',delay(function(e)
{
    var here = $(this)
    var prefix = $(this).attr('id')
    var x = prefix.indexOf('_')
    var drug_name = $.trim($(this).val())
    if(x > -1){
      prefix = prefix.substring(0,x+1)
    }else{
      prefix = ''
    }
    $('#'+prefix+'return_drug_info').remove()
// 应该获取的是目前兽医处有库存的药物，而不是公司有库存的药物
    if( drug_name != '' && drug_name !=null && drug_name != undefined){
      $.ajax({
          type:'post',
          url:'/admin/manage/material/drugs/get_drug_info',
          dataType:"json",
          data:{'drug_name':drug_name},
          success: function(msg)
          {
            // 这个地方不能用隐藏的select，而是用一个临时的select，同时绝对定位于目前的input框
            var obj=msg.drug_name
            console.log(obj)
            if(obj.length == 0){
              // 长度为0，证明没有结果
              var drug_info ='<select name="" id="'+ prefix +'return_drug_info"  class="form-control" style="position:absolute;z-index:10;border:solid 1px red;"> <option value="">兽医处没有该药品</option>  </select>'
              here.after(drug_info)
            }else{
              var drug_info = '<select name="" id="'+ prefix +'return_drug_info" class="form-control" style="width:500px; position:absolute;z-index:10;border:solid 1px red;" multiple="multiple" size="5">'
              for(var i=0;i<obj.length;i++){

                drug_info += '<option value="'+obj[i]["id"]+'">'+obj[i]['drugName']+','+obj[i]["supplier"]+','+obj[i]['unit']+'</option>'
              
              }
                drug_info +='</select>' 
                here.after(drug_info)
            }
          }
        }
      )
    }
},800)
)
var d_id =''
$("body").on('click','#return_drug_info',function(){
          var drug_id = $("#return_drug_info option:selected").val()
          var drugname = $("#return_drug_info option:selected").text()
          var x = drugname.indexOf(',')
          if(x < 0){
            $(this).prev().val("")
            $('#return_drug_info').remove()
            return;
          }
          var n = drugname.split(',')
          d_id += drug_id + ','
          $(".drug_id").val(d_id)
          $(this).prev().val(n[0] + '，Co-'+n[1])
          $(this).parent().next().find(".input_unit").html(n[2])
          $('#return_drug_info').remove()
        })