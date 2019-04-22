$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getLowerDepartment(obj,modal){
  // alert($(obj).index())
  // alert(modal)
  //   alert(obj.value);
  var dom= modal +" "+ "select"
    var tj =$(dom).length
    var presentindex=$(obj).index()
    var pid=obj.value;
    // alert(dom)
    // alert(tj)
    $('.alert-danger').remove()
    if(pid==0){ 
      $(dom +"[id !=Pid"+pid+"]").remove();
      return }
      if(tj>1){
        $(dom + ":gt('+presentindex+')").remove();
      }
       $.ajax({
        type: "post",
        url: "/admin/manage/staff/retriveDepart" ,
        dataType:"json",
        data:{'Pid':pid},
        success: function(data){
          // alert('chenggong');
          if(data){ var newgrade='<select id="Pid'+pid+'" name="Pid" class="form-control mt-2" value="'+ pid+'" onchange="getLowerDepartment(this,modal='+"'"+modal+"'"+')"><option value="'+pid+'">...直接创建或选择';}else {
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
     $(dom + ":gt('+presentindex+')").remove();
        data=data.responseText
            // 动态在页面添加错误提示信息
            str = '<div class="alert alert-danger" role="alert">';
            str +=data
            str += '</div>';
// alert(str)
            $(modal +" " + ".modal-footer").before(str);
    }
  })
    
}