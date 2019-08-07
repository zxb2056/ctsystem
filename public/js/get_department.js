$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    function get_department(obj)
    {
        var pid = obj.value
        // alert('pid是：'+pid)
        var attr_id = obj.id
        // 如果重新选择顶级部门，则删除其后所有的同胞元素。
       $('#'+attr_id).nextAll().remove()
       
        $.ajax({
            type: "post",
            url: "/admin/manage/staff/retriveDepart" ,
            dataType:"json",
            data:{'Pid':pid},
            success: function(data){
              // alert('chenggong');
              if(data)
              {
                var newgrade='<select id="department-'+pid+'" name="department-'+pid+'" class="form-control mt-2" value="'+ pid+'" onchange="get_department(this)"><option value="'+pid+'">选择下级部门'
                for(var i=0;i<data.length;i++){
                    // console.log(data[i].departName)
                    newgrade += '<option value="'+ data[i].id+'">----'+data[i].departName+'</option>'
                    }
                    newgrade+='</select>'
                    $('#'+attr_id).after(newgrade);
              }
              else 
              {
                return
              }
               
               
        },
        error:function(data){
        
        }
      })
    }
