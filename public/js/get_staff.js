$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
$(document).ready(function(){
    $('#staff').keyup(delay(function(){
        var name =$('#staff').val()
        if(name == '' || name == undefined || name == null)
        {
            return;
        }
        $.ajax({
            type: "post",
            url: "/admin/manage/staff/get_staff" ,
            dataType:"json",
            data:{'name':name},
            success: function(data){
              // alert('chenggong');
              if(data)
              {
                $("#staff_select").empty()
                var obj = data.staffs
                console.log(obj)
                if(obj.length<1){
                    $("#staff_select").append("<option value=''>"+'没有结果'+"</option>")
                    $("#staff_select").show()
                }
                for(var i=0;i<obj.length;i++){
                                        // console.log(data[i].departName)
                    $("#staff_select").append("<option value="+obj[i].id+">"+obj[i].name+"</option>")
                    }
                    $("#staff_select").show()
              }
              else 
              {
                return
              }             
        },
      })

    },500))

    $("#staff_select").change(function(){
        var staff_name = $("#staff_select option:selected").text()
        var staff_id = $("#staff_select option:selected").val()
        $('#staff').val(staff_name)
        $('#staff_id').val(staff_id)
    })

})

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