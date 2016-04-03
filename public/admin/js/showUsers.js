$(document).ready(function () {
    var tocheckbox = new Array();
    //全选和全取消
        $(document).on('change','#all-select',function(){
        //console.log($(this)[0].checked);
        if($(this)[0].checked){
            //console.log($(this).parent().parent().parent().parent().html());
            $(this).parent().parent().parent().parent().find('input[class=checkbox]').each(function(){
                this.checked = true;
            });
        }
        else{
            $(this).parent().parent().parent().parent().find('input[class=checkbox]').each(function(){
                this.checked = false;
            });
        }
    });



    $('#delect').click(function(){
        tocheckbox = [];
        //alert($('.checkbox').size());
        $(".checkbox").each(function(){
            if(this.checked == true){
                //alert(this.value);
                tocheckbox.push(this.value);
            }
        });
        console.log(tocheckbox);
        var url = 'http://localhost:82/admin/batchDel';
        var data = tocheckbox;
        $.post(url, {data:data}, function (data) {
            if (data.code == 0) {
                alert('已经成功删除！');
                window.location.reload();
             } else {
             alert('删除失败~！');
             }
        })

        $("tr").each(function(i,tr){
            console.log($(tr).find('th>input[type=checkbox]').checked);
            /*if($(tr).find('th>input[type=checkbox]').checked == true){
                console.log("123");
                console.log($(tr).html());
            }*/
        });
    });


    //查找用户函数
    $('#find-btn').on('click',function(){
       //alert($('.find').val());
        var parm = $('.find').val();
        if($('.find').val()==""){
            parm = "";
        }
        var url = 'http://localhost:82/admin/showUsers/'+parm;
        //alert(url);
        console.log('aaaa');
        window.location.href=url;
        console.log('bbbb');

    });



});