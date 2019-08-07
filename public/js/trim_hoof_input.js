$(document).ready(function(){
    // 默认不显示蹄病界面

    // alert('thanks')
    $('#diseaseOrCare2').click(function(){
        $(".disease_show").show()
    })
    $('#diseaseOrCare1').click(function(){
        $(".disease_show").hide()
    })
    // 点击固定蹄的普修时，隐藏后边的input框
    if($("#LF_diseaseOrCare1").is(':checked')){
        alert('hahaha')
        $("#ifhoof_ill").nextAll().hide()
        // 左前div内的全部input --disabled
        $("#ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    }else if($("#LF_diseaseOrCare2").is(':checked')){
        alert('hahaha')
        $("#ifhoof_ill").nextAll().removeAttr("style")
        $("#ifhoof_ill").nextAll().find(":input").removeAttr('disabled',true)
    }
 
    // $("#LF_diseaseOrCare2").click(function(){
    //     $("#ifhoof_ill").nextAll().removeAttr("style")
    //     $("#ifhoof_ill").nextAll().find(":input").removeAttr('disabled',true)
    // })
    // 右前
    $("#RF_diseaseOrCare1").click(function(){
        $("#RF_ifhoof_ill").nextAll().hide()
        // 左前div内的全部input --disabled
        $("#RF_ifhoof_ill").nextAll().attr('disabled',true)
    })
    $("#RF_diseaseOrCare2").click(function(){
        $("#RF_ifhoof_ill").nextAll().removeAttr("style")
    })
    // 左后
    $("#LB_diseaseOrCare1").click(function(){
        $("#LB_ifhoof_ill").nextAll().hide()
        // 左前div内的全部input --disabled
        $("#LB_ifhoof_ill").nextAll().attr('disabled',true)
    })
    $("#LB_diseaseOrCare2").click(function(){
        $("#LB_ifhoof_ill").nextAll().removeAttr("style")
    })
   // 右后
   $("#RB_diseaseOrCare1").click(function(){
    $("#RB_ifhoof_ill").nextAll().hide()
    // 左前div内的全部input --disabled
    $("#RB_ifhoof_ill").nextAll().attr('disabled',true)
    })
    $("#RB_diseaseOrCare2").click(function(){
        $("#RB_ifhoof_ill").nextAll().removeAttr("style")
    })
            // 点击添加药品的时候，根据不同的蹄子，有四种--右前
            $("body").on('click',".RF_plusDrug",function(){
                var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="drugUse[]" id="RF_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="RF_dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text RF_input_unit">ml</div></div></div></div> <div class="col-sm-1 RF_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">继续添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
            $("#RF_selectDrug").append(html);
            $(this).hide()
            $(this).next().hide()
            })
            //    左后
            $("body").on('click',".LB_plusDrug",function(){
                var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="LB_drugUse[]" id="LB_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="LB__dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text LB_input_unit">ml</div></div></div></div> <div class="col-sm-1 LB_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">继续添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
            $("#LB_selectDrug").append(html);
            $(this).hide()
            $(this).next().hide()
            })
           //    右后
           $("body").on('click',".RB_plusDrug",function(){
            var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="RB_drugUse[]" id="RB_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="RB__dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text RB_input_unit">ml</div></div></div></div> <div class="col-sm-1 RB_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">继续添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
           $("#RB_selectDrug").append(html);
           $(this).hide()
           $(this).next().hide()
           })
    //    对返回的值进行选择，点击插入到相应input中
        
        $("body").on('click','#RF_return_drug_info',function(){
                var d_id =''
                var drug_id = $("#RF_return_drug_info option:selected").val()
                var drugname = $("#RF_return_drug_info option:selected").text()
                var n = drugname.split(',')
                d_id += drug_id + ','
                $(".RF_drug_id").val(d_id)
                $(this).prev().val(n[0] + '，Co-'+n[1])
                $(this).parent().next().find(".RF_input_unit").html(n[2])
                $('#RF_return_drug_info').remove()
                })
                
        $("body").on('click','#LB_return_drug_info',function(){
                var d_id =''
                var drug_id = $("#LB_return_drug_info option:selected").val()
                var drugname = $("#LB_return_drug_info option:selected").text()
                var n = drugname.split(',')
                d_id += drug_id + ','
                $(".LB_drug_id").val(d_id)
                $(this).prev().val(n[0] + '，Co-'+n[1])
                $(this).parent().next().find(".LB_input_unit").html(n[2])
                $('#LB_return_drug_info').remove()
                })
            $("body").on('click','#RB_return_drug_info',function(){
                var d_id =''
                var drug_id = $("#RB_return_drug_info option:selected").val()
                var drugname = $("#RB_return_drug_info option:selected").text()
                var n = drugname.split(',')
                d_id += drug_id + ','
                $(".RB_drug_id").val(d_id)
                $(this).prev().val(n[0] + '，Co-'+n[1])
                $(this).parent().next().find(".RB_input_unit").html(n[2])
                $('#RB_return_drug_info').remove()
                })

})
    // 选择药物治疗或输液的时候，显示药品输入框
    // 点击事件不行，当点击其它的时候会消失，必须使用选中事件
$(":checkbox").click(function(){
    if($('#RF_therap1').is(':checked') || $('#RF_therap2').is(':checked') ){
      $('#RF_selectDrug').removeAttr('hidden')
    }else{
      $('#RF_selectDrug').attr('hidden',true)
    }
    if($('#LB_therap1').is(':checked') || $('#LB_therap2').is(':checked') ){
        $('#LB_selectDrug').removeAttr('hidden')
      }else{
        $('#LB_selectDrug').attr('hidden',true)
      }
      if($('#RB_therap1').is(':checked') || $('#RB_therap2').is(':checked') ){
        $('#RB_selectDrug').removeAttr('hidden')
      }else{
        $('#RB_selectDrug').attr('hidden',true)
      }
    })