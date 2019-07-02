$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if($("#whole_enterBarn").val() == $("#whole_leaveBarn").val()){
                alert('转出转入牛舍不能一样')
            }
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
function showHint(event,str)
{
    $('#inputCattle')[0].style.border="1px solid #ced4da";
    $('#warncattle').attr("hidden",'hidden')
           if(event.keyCode == 46 || event.keyCode == 8){
            var outbarn=$("#leaveBarn").val()
            // alert('您按了退格键')
            $.ajax({
                type:'post',
                url:'/admin/manage/feed/cattle_barn/getbarnCattle',
                async:false, 
                dataType:"json",
                data:{'barn_id':outbarn},
                success:function(msg){
                    $("#associate_cattleID").empty()
                    // console.log(msg)
                    var obj=msg
                   for(var i=0;i<obj.length;i++){
                        var item=obj[i];
                    $("#associate_cattleID").append("<option value="+item.id+">"+item.cattleID+"</option>");
                    }
                   
                },

        })
    }
        var finding= $('#inputCattle').val()
        const options = document.querySelector('#associate_cattleID').options
        var delet=[]
        // alert(finding)
       for (var i = 0; i < options.length; i++) {
            var str=options[i].text
            var optionvalu=options[i].value
            if(!str.match(finding)){
                delet.push(optionvalu)
            }         
        }
        for(var x in delet){
            $("#associate_cattleID option[value="+delet[x]+"]").remove()
        }



}
function hiddenwarn(obj){
    var id="#"+obj.id
    var label=$(id).data('label')
    label="#"+label
    $(id)[0].style.border="1px solid #ced4da";
    $(label).attr("hidden",'hidden')
}
$(document).ready(function(){
    getCattleEarTag();
    $("#submit").click(function(){
        var outbarn=$("#leaveBarn").val()
        var enterbarn=$("#enterBarn").val()
        var reason=$("#reason").val().replace(/(^\s*)|(\s*$)/g, '')
        var changeday=$("#changeDay").val()
        if(outbarn==enterbarn){
            alert('转出转入牛舍不能相同')
        return
        }
        if(reason=='' || reason==undefined || reason == null){
            $('#reason')[0].style.border="1px solid red";
            $('#changeReason').removeAttr("hidden")

        }else{
            $('#reason')[0].style.border="1px solid #ced4da";
            $('#changeReason').attr("hidden",'hidden')
        }
        if(changeday=='' || changeday==undefined || changeday == null){
            $('#changeDay')[0].style.border="1px solid red";
            $('#changeDaywarn').removeAttr("hidden")

        }else{
            $('#changeDay')[0].style.border="1px solid #ced4da";
            $('#changeDaywarn').attr("hidden",'hidden')
        }
        const options = document.querySelector('#associate_cattleID').options
        const cattleID = []
        for (var i = 0; i < options.length; i++) {
         // 如果该option被选中，则将它的value存入数组
         if (options[i].selected) {
             cattleID.push(options[i].value)
         }
     }
     if(Array.isArray(cattleID) && cattleID.length === 0){
         alert('注意，没有选定数据')
         return;
     }
        $.ajax({
            type:'post',
            url:'/admin/manage/feed/cattle_barn/insertChangeBarn',
            dataType:"json",
            data:{'leaveBarn':outbarn,'enterBarn':enterbarn,'reason':reason,'cattleID':cattleID,'changeDay':changeday},
            success:function(msg){
            // alert('done')
            getCattleEarTag();
            $("#inputCattle").val("")
                },
               
            })
    })
    //显示所选牛舍包含的牛号
    function getCattleEarTag(){
        var outbarn=$("#leaveBarn").val()
        $.ajax({
           type:'post',
           url:'/admin/manage/feed/cattle_barn/getbarnCattle',
           dataType:"json",
           async:false, 
           data:{'barn_id':outbarn},
           success:function(msg){
               $("#associate_cattleID").empty()
               // console.log(msg)
               var obj=msg
              for(var i=0;i<obj.length;i++){
                   var item=obj[i];
               $("#associate_cattleID").append("<option value="+item.id+">"+item.cattleID+"</option>");
               }
           },
   
       })

    }
    

    $("#leaveBarn").change(function(){
        var outbarn=$("#leaveBarn").val()
        $.ajax({
            type:'post',
            url:'/admin/manage/feed/cattle_barn/getbarnCattle',
            dataType:"json",
            data:{'barn_id':outbarn},
            success:function(msg){
                $("#associate_cattleID").empty()
                console.log(msg)
                var obj=msg
               for(var i=0;i<obj.length;i++){
                    var item=obj[i];
                $("#associate_cattleID").append("<option value="+item.id+">"+item.cattleID+"</option>");
                }
            },
    
        })


    })


})
