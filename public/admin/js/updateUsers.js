$(document).ready(function () {

    $('#submit').click(function () {
        if ((account = $('#account').val()) == '') {
            alert('用户名不能为空！');
            return;
        }
        if ((userName = $('#userName').val()) == '') {
            alert('姓名不能为空！');
            return;
        }
        group = $('#group').val();
        rank = $('#rank').val();
        tmp = $('#tmp').text();
        var url = $('form').attr('action');


        var data = {
            'account': account,
            'userName': userName,
            'group': group,
            'rank': rank,
            'tmp':tmp
        }

        $.post(url, data, function (data) {
            if (data.code == 0) {
                $('#prompt-info').text(data.msg);
            } else {
                $('#prompt-info').text('失败咯~！');
            }
        })
    });

/*    $('#submit').click(function () {
        if ((account = $('#account').val()) == '') {
            alert('用户名不能为空！');
            return;
        }
        if ((userName = $('#userName').val()) == '') {
            alert('姓名不能为空！');
            return;
        }
        group = $('#group').val();
        rank = $('#rank').val();

        var url = $('form').attr('action');
        var data = {
            'account': account,
            'userName': userName,
            'group': group,
            'rank': rank
        }

        $.post(url, data, function (data) {
            if (data.code == 0) {
                $('#prompt-info').text(data.msg);
            } else {
                $('#prompt-info').text(data.msg);
            }
        })
    });*/

});
