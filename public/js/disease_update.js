// 这是更新疾病页面，对diease_input.js的补充
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// 当点击重新确定疾病名称时，后面的input框显示，同时required,当点击无变化的时候，input框隐藏，required，false.
$(document).ready(function(){
    $("#new_disease_name2").click(function(){
        $("#new_dname").show()
        $("#new_dname").attr('required',true)
    })
    $("#new_disease_name1").click(function(){
        $("#new_dname").hide()
        $("#new_dname").attr('required',false)
    })
})



// 通用延迟函数
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