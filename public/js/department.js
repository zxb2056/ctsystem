$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function getLowerDepartment(obj,modal){
  var dom= modal +" "+ "select"
    // var presentindex=$(obj).index()
    var pid=obj.value;
    // 删除当前select框之后的所有select框
    var attr_id = obj.id
    $('#'+attr_id).nextAll().remove()
    $('.alert-danger').remove()
       $.ajax({
        type: "post",
        url: "/admin/manage/staff/retriveDepart" ,
        dataType:"json",
        data:{'Pid':pid},
        success: function(data){
          // alert('chenggong');
          if(data){ var newgrade='<select id="Pid'+pid+'" name="Pid" class="form-control mt-2" value="'+ pid+'" onchange="getLowerDepartment(this,modal='+"'"+modal+"'"+')"><option value="'+pid+'">直接创建或继续选择下级部门';}else {
            return;
          }
          for(var i=0;i<data.length;i++){
            // console.log(data[i].departName)
            newgrade += '<option value="'+ data[i].id+'">----'+data[i].departName+'</option>'
            }
            newgrade+='</select>'
            $(dom + ":last").after(newgrade);
           
    },
    error:function(data){
    $('.alert-danger').remove()
     $('#'+attr_id).nextAll().remove()
        data=data.responseText
            // 动态在页面添加错误提示信息
            str = '<div class="alert alert-danger" role="alert">';
            str +=data
            str += '</div>';
            $(modal +" " + ".modal-footer").before(str);
    }
  })
    
}