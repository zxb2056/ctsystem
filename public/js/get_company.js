$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#supplier").keyup(delay(function(){
    var name= $("#supplier").val()
    $("#supplier_back").hide();
    get_company(name)
},300))
$("#supplier_info").change(function(){
  var company_name = $("#supplier_info option:selected").text()
  var company_id = $("#supplier_info option:selected").val()
  $("#supplier").val(company_name)
  $("#supplier_id").val(company_id)
  // alert(company_id)
  $("#supplier_info").hide()
})
function get_company(company_name){
  $.ajax({
    type:'post',
    url:'/admin/manage/supplier/get_company',
    dataType:"json",
    data:{'company_name':company_name},
    success: function(msg){
      $("#supplier_info").empty()
      $("#supplier_info").show();
      var obj=msg.company_name
      if(obj.length == 0){
        $("#supplier_info").hide();
        $("#supplier_back").show();
      }else{
        for(var i=0;i<obj.length;i++){
          var item=obj[i];
          $("#supplier_info").append("<option value="+item['id']+">"+item['company_name']+"</option>");
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