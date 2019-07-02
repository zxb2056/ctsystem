function myFunction(){
    alert('hello world')
}
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#resetinput").click(function(){
        $('input').attr("value","");
    })
    $("#showall").click(function(){
        $('input').attr("value","");
        window.location= '/admin/manage/basic/cattleinfo'
    })
})
function sortby(obj){
    var tagName=obj.id
    var sortby=obj.getAttribute('data-sortby')
    var sorttype=obj.getAttribute('data-sorttype')
    var inputArr = $("#form1 input[type='text'],#form1 input[type='date'],#form1 select")
    var str ='{'
    inputArr.each(function(){
        // console.log($(this).attr("name") + '---'+$(this).val() )
        
        name=$(this).attr("name")
        value=$(this).val()
        // myMap.set(name,value)
        str += '"'+name+'"';
        str +=':';
        if(value==''){
            //php解析空值的时候,需要以双引号代替.否则出错.
            str += '""'+','
        }else{
            str += '"'+ value+'",'
        }
        

    })
    str += '"sortby"'+':'+'"'+sortby+'"'
    str += '}'

    console.log(str)

$.ajax({
    type:'get',
    url:'/admin/manage/basic/cattleinfo/sortby',
    datatype:'json',
    data:{"datas":str},
    success:function(data){
        //这里是执行成功之后要走的地方
        var obj = JSON.parse(data)
        console.log(obj.data)
        console.log(obj.sorttype)
        window.location.href="/admin/manage/basic/cattleinfo/sortby?"+ obj.data;
      
        }
})

}