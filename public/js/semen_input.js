$(document).ready(function(){
    $("#price").keyup(function(){
        var UnitPrice=$("#price").val()
        var amount=$("#semenAmount").val()
        if(amount != '' && amount !=undefined && amount !=null){
            var total=UnitPrice*amount
            // alert(total)
            $("#totalSum").val(total)
        }
    })

})