$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#submit").click(function(){
       
       var barn_id =$('#selectbarn option:selected').val();//选中的文本
    //    alert(barn_id)
       const options = document.querySelector('#cattleID').options
       const selectedValueArr = []
       for (var i = 0; i < options.length; i++) {
        // 如果该option被选中，则将它的value存入数组
        if (options[i].selected) {
            selectedValueArr.push(options[i].value)
        }
    }
    if(Array.isArray(selectedValueArr) && selectedValueArr.length === 0){
        alert('注意，没有选定数据')
        return;
    }
            $.ajax({
                type:'post',
                url:'/admin/manage/basic/barnmapindividual/plusbarn_cattle',
                dataType:"json",
                data:{'cattle_id':selectedValueArr,'barn_id':barn_id},
                success: function(msg){
                    var data=msg;
                    $("#cattleID").empty();//首先清空select现在有的内容
                    for(var i=0;i<data.length;i++){
                        var item=data[i];
                    $("#cattleID").append("<option value="+item.id+">"+item.cattleID+"</option>");
                    }
                    $("#cattleID").trigger("focus");
                  },
                  error:function(msg){
                    if (msg.status == 422) {
 

                    } else {
                        alert('服务器连接失败');
                        return ;
                    }

                   
                  
                  }
                })

            })

})