var id = $('meta[name="id_user"]').attr('content');
var count = $('meta[name="count"]').attr('content');
$(document).ready(function() {
    window.Echo.private(`App.Models.User.` + id)
        .notification((notification) => {
            addNotifications([notification], '#notifications', '#count-notification', parseInt(count) );
        });
});

function addNotifications(newNotifications, target, count_target, count) {
    notifications = _.concat(notifications, newNotifications);
    $(count_target).html(notifications.length + count - 1);
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('unseen')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">' + Lang.get('en.notify.no_noti') + '</li>');
        $(target).removeClass('unseen');
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var id = getIdNotification(notification);
    var notificationText = makeNotificationText(notification);

    return '<li><a href="' + to + '" class="nav-link seenSingle" id = "'+ id +'">' + notificationText + '</a></li>';
}

const NOTIFICATION_TYPES = {
    newOrder: 'App\\Notifications\\NewOrder',
    newStatus: 'App\\Notifications\\NewStatusOrder',
    orderProcessing : 'App\\Notifications\\OrderProcessingNotification',
};

function getIdNotification(notification) {

    return notification.id;
}
function routeNotification(notification) {
    var to = '';
    if(notification.type === NOTIFICATION_TYPES.newOrder) {
        id = notification.user_id;
        to = '/admin/user/' + id;
    }
    else if(notification.type === NOTIFICATION_TYPES.newStatus) {
        id = id;
        to = `/checkout/` + id;
    } else {
        to = `/admin/order/index`;
    }

    return to;
}

function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.newOrder) {
        var name = notification.user_name;
        text += Lang.get('en.notify.newOrder') + `<strong>${name}</strong>`;
    }
    else if(notification.type === NOTIFICATION_TYPES.newStatus) {
        const id = notification.id_transaction;
        let status = notification.status_transaction;
        text += Lang.get('en.notify.yourorderat') +` <strong>${id}</strong> : <strong>${status}</strong>`;
    } else {
        text += Lang.get('en.notify.youhavea') + ` <strong>` + Lang.get('en.notify.pending') + `</strong>` + Lang.get('en.notify.orderneed');
    }

    return text;
}

$(document).on('click', '.seenSingle', function(e){
    $(this).parent().removeClass('unseen');
    var id = $(this).attr('id');
    var direct = $(this). attr("href");
    var url = "/notifications/mark/" + id;
    var options = {
        url:url,
        type:"get",
        data:{
            id : id,
        },
        success:function(response)
        {
            if($('#count-notification').html() > 0){
                $('#count-notification').html($('#count-notification').html() - 1);
            }
            window.location = direct;
        },
        error: function (request, error) {
            alert( Lang.get('en.notify.error_ajax') + error);
        }
    }
    e.preventDefault();
    $.ajax(options);
});

$(document).on('click', '.seenAll', function(e){
    var url = "/notifications/marks";
    var options = {
        url:url,
        type:"get",
        success:function(response)
        {
            $('#count-notification').html('');
            $('.dropdown-menu li').removeClass('unseen');
        },
        error: function (request, error) {
            alert(Lang.get('en.notify.error_ajax') + error);
        }
    }
    e.preventDefault();
    $.ajax(options);
});
