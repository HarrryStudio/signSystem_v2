$(document).ready(function () {


    $('#addInfo').click(function () {

        var data = new Array();
        data[0]=$('#userName').val();  //赋值
        data[1]=$('#pasd').val();
        data[2]=$('#group').val();
        data[3]=$('#class').val();
        data[4]=$('#phone').val();
        data[5]=$('#email').val();
        data[6]=$('#qq').val();
        data[7]=$('#address').val();
        alert(data);


    });


});