$(document).ready(function(){
   $("#barn_id").change(function(){
       var barn_id = $("#barn_id option:selected").val()
       $('#cattle_num_div').hide()
       if(barn_id != '' && barn_id != null && barn_id != undefined){
        get_barn_num(barn_id)
       }
        
   })
    
})
function get_barn_num(barn_id){
    $.ajax({
        type: "post",
        url: "/admin/manage/Veterinary/get_barn_cattle_num" ,
        dataType:"json",
        data:{'barn_id':barn_id},
        success: function(msg){
            var obj = msg.cattle_num
            $("#barn_cattle_num").html(obj)
            $('#cattle_num_div').show()
            }
    })

}