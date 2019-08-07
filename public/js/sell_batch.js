$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#totalCattleNum").val('1')

    $('#cattleID').keyup(delay(function (e) {
        var cattleID = this.value
        var arr = cattleID.split(',')
       var cattleNum= arr.length
       $("#totalCattleNum").val(cattleNum)
       checkCattle(cattleID)
     }, 1000));
    $('#cattleFrom').change(function(){
        if($("#cattleFrom option:selected").val() == '整舍'){
            $("#barndiv").css('display','')
            $("#cattleIDdiv").css('display','none')
            $("#totalCattleNum").val('')
            $("#cattleID").removeAttr('required')
        }else if($("#cattleFrom option:selected").val() == '单个出售'){
            $("#barndiv").css('display','none')
            $("#cattleIDdiv").css('display','')
            $("#totalCattleNum").val('1')
            $(".check-feedback").html('')
            $(".check-feedback").Attr('hidden')
            $("#cattleID").attr("required", "required")
            $('#cattleID').keyup(delay(function (e) {
                var cattleID = this.value
                var arr = cattleID.split(',')
               var cattleNum= arr.length
               $("#totalCattleNum").val(cattleNum)
               checkCattle(cattleID)
             }, 2000));
        }else {
            $("#barndiv").css('display','none')
            $("#cattleIDdiv").css('display','')
            $("#totalCattleNum").val('')
            $("#cattleID").attr("required", "required")
            $("#cattleID").off("paste").on("paste",function(e){
                var paste = e.originalEvent.clipboardData.getData('Text');
                var arr = paste.split(',')
                var cattleNum= arr.length
                $("#totalCattleNum").val(cattleNum)
                checkCattle(paste)
             })
             $('#cattleID').keyup(delay(function (e) {
                 var cattleID = this.value
                 var arr = cattleID.split(',')
                var cattleNum= arr.length
                $("#totalCattleNum").val(cattleNum)
                checkCattle(cattleID)
              }, 2000));
        }
    })
    $('#barnID').change(function(){
        var barnid= $("#barnID option:selected").val()
        $.ajax({
            type:'post',
            url:'/admin/manage/feed/getBarnNum',
            dataType:"json",
            data:{'barnid':barnid},
            success: function(msg){
                console.log(msg)
                $("#totalCattleNum").val(msg)
              }  
        })

    })
    function checkCattle(cattleID){

        $.ajax({
            type:'post',
            url:'/admin/manage/feed/check_cattle',
            dataType:"json",
            data:{'cattleID':cattleID},
            success: function(msg){
                 if(msg.count > 1){
                    $(".check-feedback").html(msg.cattle + '以上共'+ msg.count +' 个牛号不存在,请核对')
                    $(".check-feedback").removeAttr('hidden')
                    $("#sell_batch_submit").attr("disabled",true)
                    $("#totalCattleNum").val(msg.cattleNum)
                }else if(msg.count == 1) {
                    $(".check-feedback").html(msg.cattle + '牛号不存在,请核对')
                    $(".check-feedback").removeAttr('hidden')
                    $("#sell_batch_submit").attr("disabled",true)
                    $("#totalCattleNum").val(msg.cattleNum)
                }else if(msg.count == 0){
                    $(".check-feedback").attr("hidden",true)
                    if(msg.error > 0){
                        $("#sell_batch_submit").attr("disabled",true)
                        $("#totalCattleNum").val(msg.cattleNum)
                    }else if (msg.error == 0){
                        $("#sell_batch_submit").attr("disabled",false)
                        $("#totalCattleNum").val(msg.cattleNum)
                    }
                }
               
              }  
        })
    }
    // 获得理论价值
    $("#totalWeight").blur(function(){
        var w = $("#totalWeight").val()
        var p = $("#PricePerKg").val()
        
        $("#theoryIncome").val(w*p) 
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
    
})