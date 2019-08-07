$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
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
                $("#submit").attr("disabled",true)
                $("#totalCattleNum").val(msg.cattleNum)
            }else if(msg.count == 1) {
                $(".check-feedback").html(msg.cattle + '牛号不存在,请核对')
                $(".check-feedback").removeAttr('hidden')
                $("#submit").attr("disabled",true)
                $("#totalCattleNum").val(msg.cattleNum)
            }else if(msg.count == 0){
                $(".check-feedback").attr("hidden",true)
                if(msg.error > 0){
                    $("#submit").attr("disabled",true)
                    $("#totalCattleNum").val(msg.cattleNum)
                }else if (msg.error == 0){
                    $("#submit").attr("disabled",false)
                    $("#totalCattleNum").val(msg.cattleNum)
                }
            }
           
          }  
    })
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