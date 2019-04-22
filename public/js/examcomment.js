$(".verifyComment").click(function(event){
target = $(event.target);
var commentid=target.attr('commentid');
var commentstatus = target.attr('comment-status');

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
})
$.ajax({
    url: "/admin/comment/" + commentid +"/status",
    method:"POST",
    data:{"status":commentstatus},
    dataType:'json',
    success:function(data){
        if(data.error !=0) {
            alert(data.msg);
            return;
        }
        target.parent().parent().remove();
    }

})

})