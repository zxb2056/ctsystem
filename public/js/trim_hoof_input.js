$(document).ready(function(){
    // 默认不显示蹄病界面

    // alert('thanks')
    $('#diseaseOrCare2').click(function(){
        // 判断修蹄数量至少选择一个，如果没有，提示选择，并返回，因为复用，形成函数
        whether_checked()
        $(".disease_show").show()
        if($("#left-front").is(':checked')){
            $("#left-front-div").show()
        }else{
            $("#left-front-div").hide()
        }
        if($("#right-front").is(':checked')){
            $("#right-front-div").show()
        }else{
            $("#right-front-div").hide() 
        }
        if($("#left-back").is(':checked')){
            $("#left-back-div").show()
        }else{
            $("#left-back-div").hide() 
        }
        if($("#right-back").is(':checked')){
            $("#right-back-div").show()
        }else{
            $("#right-back-div").hide()
        }

    })
    $('#diseaseOrCare1').click(function(){
        $(".disease_show").hide()
        disabled_after()
    })
    // 选择复选框时，即时显示对就的蹄子div--click事件
    $("#left-front").click(function(){
        if($("#left-front-div").css('display') == 'none'){
            $("#left-front-div").show()
        }else{
            $("#left-front-div").hide()
        }
    })
    $("#right-front").click(function(){
        if($("#right-front-div").css('display') == 'none'){
            $("#right-front-div").show()
        }else{
            $("#right-front-div").hide()
        }
    })
    $("#left-back").click(function(){
        if($("#left-back-div").css('display') == 'none'){
            $("#left-back-div").show()
        }else{
            $("#left-back-div").hide()
        }
    })
    $("#right-back").click(function(){
        if($("#right-back-div").css('display') == 'none'){
            $("#right-back-div").show()
        }else{
            $("#right-back-div").hide()
        }
    })


    // 点击固定蹄的普修时，隐藏后边的input框
    // if判断只运行一次，如果想让每次运行，必须包含在click事件里
    // 这里是假设没有点击，直接按普修提交，则后边的表单全部是disabled,即不提交数据
    if($("#diseaseOrCare1").is(':checked')){
        $(".disease_show").hide()
        disabled_after()
    }
    // 
    $("#LF_diseaseOrCare1").click(function(){
        $("#ifhoof_ill").nextAll().hide()
        // 左前div内的全部input --disabled
        $("#ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    })
    $("#LF_diseaseOrCare2").click(function(){
        $("#ifhoof_ill").nextAll().removeAttr("style")
        $("#ifhoof_ill").nextAll().find(":input").removeAttr('disabled',true)
    })
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
                var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="RF_drugUse[]" id="RF_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="RF_dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text RF_input_unit">ml</div></div></div></div> <div class="col-sm-1 RF_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
            $("#RF_selectDrug").append(html);
            $(this).hide()
            $(this).next().hide()
            })
            //    左后
            $("body").on('click',".LB_plusDrug",function(){
                var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="LB_drugUse[]" id="LB_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="LB_dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text LB_input_unit">ml</div></div></div></div> <div class="col-sm-1 LB_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
            $("#LB_selectDrug").append(html);
            $(this).hide()
            $(this).next().hide()
            })
           //    右后
           $("body").on('click',".RB_plusDrug",function(){
            var html = '<div class="col-sm-3 offset-sm-3 my-1"><input type="text" name="RB_drugUse[]" id="RB_drugUse" class="form-control get_drug_info" autocomplete="off"></div><div class="input-group mt-1 col-sm-3 my-1"><input type="text" class="form-control"  placeholder="用量" name="RB_dosage[]"> <div class="input-group-prepend"> <div  class="input-group-text RB_input_unit">ml</div></div></div></div> <div class="col-sm-1 RB_plusDrug"><i class="fa fa-plus-circle text-danger " aria-hidden="true"  style="cursor:pointer;">添加</i></div><div class="col-sm-1  minusDrug"><i class="fa fa-plus-circle text-danger" aria-hidden="true"  style="cursor:pointer;">删除</i></div>'
           $("#RB_selectDrug").append(html);
           $(this).hide()
           $(this).next().hide()
           })
    //    对返回的值进行选择，点击插入到相应input中
        
        $("body").on('click','#RF_return_drug_info',function()
            {
                var d_id =$(".RF_drug_id").val()
                var drug_id = $("#RF_return_drug_info option:selected").val()
                var drugname = $("#RF_return_drug_info option:selected").text()
                var n = drugname.split(',')
                if(drug_id != undefined && drug_id != '' && drug_id != null){
                    d_id += drug_id + ','
                    $(".RF_drug_id").val(d_id)
                    $(this).prev().val(n[0] + '，Co-'+n[1])
                    $(this).parent().next().find(".RF_input_unit").html(n[2])
                    $('#RF_return_drug_info').remove()
                }else{
                    $('#RF_return_drug_info').remove()
                    return;
                }
            })
                
        $("body").on('click','#LB_return_drug_info',function(){
                    var d_id =$("#LB_drug_id").val()
                    var drug_id = $("#LB_return_drug_info option:selected").val()
                    var drugname = $("#LB_return_drug_info option:selected").text()
                    var n = drugname.split(',')
                    if(drug_id != undefined && drug_id != '' && drug_id != null){
                        d_id += drug_id + ','
                        $("#LB_drug_id").val(d_id)
                        $(this).prev().val(n[0] + '，Co-'+n[1])
                        $(this).parent().next().find("#LB_input_unit").html(n[2])
                        $('#LB_return_drug_info').remove()
                    }else{
                        $('#LB_return_drug_info').remove()
                        return;
                    }
                })
            $("body").on('click','#RB_return_drug_info',function(){
                var d_id =$("#RB_drug_id").val()
                var drug_id = $("#RB_return_drug_info option:selected").val()
                var drugname = $("#RB_return_drug_info option:selected").text()
                var n = drugname.split(',')
                if(drug_id != undefined && drug_id != '' && drug_id != null){
                    d_id += drug_id + ','
                    $("#RB_drug_id").val(d_id)
                    $(this).prev().val(n[0] + '，Co-'+n[1])
                    $(this).parent().next().find("#RB_input_unit").html(n[2])
                    $('#RB_return_drug_info').remove()
                }else{
                    $('#RB_return_drug_info').remove()
                    return;
                }
                })
                // 提交事件，判断checkbox 至少选择一个
                // 判断有药品名，而没有用药量的情况，进行提示
                $("#submit").click(function(){
                    whether_checked()
                    
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
                    
                    // 点击出现相应的状态框
                    $("#RF_status2").click(function(){
                        $("#RF_treatmentResult").removeAttr('hidden')
                        $("#RF_dailyResult").attr("hidden",true)
                        })
                        $("#RF_status1").click(function(){
                        $("#RF_treatmentResult").attr("hidden",true)
                        $("#RF_dailyResult").removeAttr("hidden")

                    })
                    $("#LB_status2").click(function(){
                        $("#LB_treatmentResult").removeAttr('hidden')
                        $("#LB_dailyResult").attr("hidden",true)
                        })
                        $("#LB_status1").click(function(){
                        $("#LB_treatmentResult").attr("hidden",true)
                        $("#LB_dailyResult").removeAttr("hidden")

                    })
                    $("#RB_status2").click(function(){
                        $("#RB_treatmentResult").removeAttr('hidden')
                        $("#RB_dailyResult").attr("hidden",true)
                        })
                        $("#RB_status1").click(function(){
                        $("#RB_treatmentResult").attr("hidden",true)
                        $("#RB_dailyResult").removeAttr("hidden")

                    })
})
    

    function disabled_after(){
    $("#ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    $("#RF_ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    $("#LB_ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    $("#RB_ifhoof_ill").nextAll().find(":input").attr('disabled',true)
    }
    function whether_checked(e){
        if($('input[name="hoof[]"]:checked').length=='0'){
            alert('至少选择一个牛蹄')
            return;
        }
    }