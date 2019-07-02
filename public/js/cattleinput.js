$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(':radio').click(function(){
        var value=$(this).val()  
        if(value=='外购'){
            $("#ComefromOut").removeAttr('disabled')
            $("#enterDayOut").removeAttr('disabled')
            $("#enterWeightOut").removeAttr('disabled')
        }
        if(value=='自繁'){
            $("#ComefromOut").attr("disabled",true);
            $("#enterDayOut").attr("disabled",true);
            $("#enterWeightOut").attr("disabled",true);
        }
    });
    $("#add_breed_variety").click(function(){
        var name=$('#breedName').val()
        var name=name.replace(/(^\s*)|(\s*$)/g, "")
        if(name=='' || name == undefined || name == null){
            alert('品种名称不能为空')
        }else(
            $.ajax({
                type:'post',
                url:'/admin/manage/basic/cattleinfo/plus_breed_variety',
                dataType:"json",
                data:{'name':name},
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
        )
       

    })
    $('#addBreedModal').on('hidden.bs.modal',function(){
        window.location.reload();
    })

})