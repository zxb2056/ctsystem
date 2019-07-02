$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#year-select").change(function(){
        year = $("#year-select").find("option:selected").text()
        $.ajax({
            type:'post',
            url:'/admin/manage/breed/mateplan/month',
            dataType:"json",
            data:{'year':year},
            success: function(msg){
                var returndata=msg.data
                var returnerror=msg.error
                // alert(returnerror)
                if(returnerror==0){
                var alertinfo ='<div class="alert alert-danger" id="feedrecordnone"><span class="mr-5"><strong></strong></span>'+returndata+'</div>'
                $("#breedinsert").after(alertinfo);
              }  
              },
              error:function(msg){
                if (msg.status == 422) {
                   json= '<div class="alert alert-danger" id="feedrecordnone"><span class="mr-5"><strong>警告:</strong></span>该品种已存在</div>'
                   $(".alert").remove();
                   $("#breedinsert").before(json);

                } else {
                    alert('服务器连接失败');
                    return ;
                }

               
              
              }

        })


    })

})