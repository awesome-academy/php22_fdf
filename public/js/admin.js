$(document).on('click', '.status-transaction', function (e) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var info = $(this).attr('id');
    var status = info.slice(0,1);
    var id = info.slice(1);
    if(status == 0){
        $(this).removeClass('badge-info').addClass('status-transaction text-lg-left badge badge-success');
        $(this).html('Done');
        status = 1;
    }else if(status == 1){
        $(this).removeClass('badge-success').addClass('status-transaction text-lg-left badge badge-danger');
        $(this).html('Reject');
        status = 2;
    }else {
        $(this).removeClass('badge-danger').addClass('status-transaction text-lg-left badge badge-info');
        $(this).html('Pending');
        status = 0;
    }
    var url = "/admin/order/change-status/" + id +"/" + status;
    var options = {
        url:url,
        type: 'POST',
        data: {
            status:status,
            id:id,
            _token: token,
        },
        success: function success(response) {
            alert(response.mess);
        },
        error: function error(err) {
            alert(" Can't do because: " + err);
        }
    };
    e.preventDefault();
    $.ajax(options);
});

$(document).ready(function(){
    $("#choice").change(function(){
        var textselected =  document.getElementById("choice").value ;
        target = '.' + textselected;
        if (textselected !== 'all'){
            $('.choice').hide();
            $(target).show();
        } else {
            $('.choice').show();
        }
    });
});
