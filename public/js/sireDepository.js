$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// alert('见到我表示一切正常')
var company=$("#belongToCompany").val()
var birthday=$("#birthday").val()
var father=$("#father").val()
var dam=$("#dam").val()

$(document).ready(function(){
    
    $("#form1 #cattleID").keyup(function(){
        console.log('1112222')
        $("#form1").find("#breedType,#nation,#belongToCompany,#birthday,#father,#grandSire,#grandDam,#dam,#outgrandSire,#outgrandDam").val("")
    })
    $("#form1 #breedType,#form1 #nation").change(function(){
        console.log('111')
        $("#form1").find('#warnExist1,#warnExist2,#warnExist3').attr("hidden",'hidden')
        // $("#belongToCompany,#birthday,#")
    })
    $("#breedType,#nation").blur(function(){
        
        var sire=$("#form1 #cattleID").val()
        var nation=$("#form1 #nation option:selected").text()
        nation = nation.replace(/^.+--?/gi,'')
        var breedType=$("#form1 #breedType option:selected").text()
        // alert(breedType)
        if(sire=='' || sire==undefined || sire == null){
            return;
        }else{
            $.ajax({
                type:'get',
                url:'/admin/manage/basic/cattlesire/query_sire_depository',
                datatype:'json',
                data:{"sire":sire,"nation":nation,"breedType":breedType},
                success:function(data){
                    //这里是执行成功之后要走的地方
                    var obj = JSON.parse(data)
                      if(obj.error == 1){
                   console.log(obj.info)
                 $('#form1 #warnExist1').removeAttr("hidden")
    
               }else if(obj.error == 0){
                console.log(obj.birthday.belongToCompany.id)
                $("#belongToCompany option[value="+obj.birthday.belongToCompany.id+"]").attr('selected','selected')
                $("input[name='father']").val(obj.info.father)
                $("input[name='dam']").val(obj.info.mother)
                $("input[name='birthday']").val(obj.birthday.birthDay)
                $("input[name='grandSire']").val(obj.grandsire.father)
                $("input[name='grandDam']").val(obj.grandsire.mother)
                $("input[name='outgrandSire']").val(obj.grandDam.father)
                $("input[name='outgrandDam']").val(obj.grandDam.mother)
                
                $('#warnExist2').removeAttr("hidden")
                setTimeout(function(){
                    $("#warnExist2").hide();
                    },2000);
                
               }else{
                $('#warnExist3').removeAttr("hidden")
               }
                  
                    }
            })
        }
        
    })
    

})

