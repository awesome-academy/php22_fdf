$(document).on('click', '#logout-span', function (e) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var options = {
        type: 'POST',
        data: {
            _token: token
        },
        url: '/logout',
        success: function success() {
            location.reload();
        },
        error: function error(err) {
            alert('Lỗi :' + err);
        }
    };
    e.preventDefault();
    $.ajax(options);
});
