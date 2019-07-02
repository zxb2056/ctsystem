$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#closeExperiModal').on('show.bs.modal', function (event) {
  var id=$('#experiment_id').val()
  if($("#feedrecordnone").length==0){
  $.ajax({
    type: "post",
    url: "/admin/manage/performance/feed_conversion/experi/checkfeedrecord" ,
    dataType:"json",
    data:{'id':id},
    success: function(msg){
      var returndata=msg.data
      var returnerror=msg.error
      // alert(returnerror)
      if(returnerror==1){
      var alertinfo ='<div class="alert alert-danger" id="feedrecordnone"><span class="mr-5"><strong>警告:</strong></span>'+returndata+'</div>'
      $("#experiname").before(alertinfo);
    }  
    },
    error:function(msg){
      alert('成功但是有错误');
    
    }
  })
}
})


