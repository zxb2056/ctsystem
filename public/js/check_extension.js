
$(document).ready(function(){
    $('#company_submit').click(function(){
        var path = $("#license_photo").val();
        if (path.length == 0) {
            alert("请选择营业执照图片,jpg,jpeg,png格式!");
            return false;
        } else {
            var extStart = path.lastIndexOf('.'),
                ext = path.substring(extStart, path.length).toUpperCase();
            if (ext !== '.PNG' && ext !== '.JPG' && ext !== '.JPEG') {
                alert("请选择正确的图片格式!");
                return false;
            }
        }
    })

})