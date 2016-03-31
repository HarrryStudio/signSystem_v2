function ajax(account){

    var url = $('form').attr('action');
    var data = {
        'account': account,
    }

    $.post(url, data, function (data) {
        if (data.code == 0) {
            alert(data.msg);
        } else {
            alert(data.msg);
        }
    })
};
