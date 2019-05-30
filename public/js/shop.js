$(document).on('click', '.delete-item', function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
    var url = '/cart/' + id;
    var options = {
        url:url,
        method:'delete',
        data:{
            id : id,
            _token: token,
        },
        success:function(response)
        {
            $('#delete-item' + id).remove();
            $('#cartbox__item' + id).remove();
            $('.totalQty').html(response.totalQty);
            $('.totalPrice').html(response.totalPrice);
            $('.grandtotal .price').html(response.totalPrice);
            $('.cartbox__total__title').siblings().html(response.totalPrice);
        },
        error: function () {
            alert(Lang.get('en.cart.error'));
        }
    }
    e.preventDefault();
    $.ajax(options);
});

$(document).ready(function(){
    $(".number_quantity").change(function(){
        var oldprice = $(this).parent().next().text().slice(1);
        var quantity =  $(this).val();
        var price = $(this).parent().prev().children().text().slice(1);
        var totalPrice = parseInt($('.totalPrice').text().slice(1));
        var subtotal = totalPrice  + quantity*price - oldprice ;
        $(this).parent().next().html(Lang.get('en.cart.dollar') + quantity*price);
        $('.totalPrice').html(Lang.get('en.cart.dollar') + subtotal);
    });
});

$(document).ready(function(){
    $(".input_quantity").change(function(e){
        var id = $(this).attr('id');
        var quantity =  $(this).val();
        console.log(quantity);
        var url = '/checkCart/' + id;
        var options = {
            url:url,
            method:'GET',
            data:{
                quantity : quantity,
                id : id,
            },
            success:function(response)
            {
                console.log(response.status);
                if (!response.status) {
                    if (response.quantity === 0) {
                        alert(Lang.get('en.cart.out_of'));
                        $('.input_quantity').val(response.quantity);
                        location.reload();
                    } else {
                        alert("Just have " + response.quantity );
                        $('.input_quantity').val(response.quantity);
                    }
                }
            },
            error: function (err) {
                if(arguments[2] === 'Unauthorized'){
                    $('.accountbox-wrapper').addClass('accountbox-wrapper is-visible');
                }else{
                    alert(Lang.get('en.cart.error'));
                }
            }
        }
        e.preventDefault();
        $.ajax(options);
    });
});

$(document).on('click', '.add-btn', function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var quantity = $('.quantity').val();
    if(quantity > 0 ) {
        var id = $(this).attr('id');
        var url = '/cart/' + id;
        var options = {
            url:url,
            method:'PUT',
            data:{
                quantity : quantity,
                id : id,
                _token: token,
            },
            success:function(response)
            {
                if (response.status) {
                    $('.cartbox-wrap').addClass('cartbox-wrap is-visible');
                    $('.totalQty').html(response.totalQty);
                    $('.grandtotal .price').html( '$'+ response.totalPrice);
                    $('.cartbox__total__title').siblings().html('$' + response.totalPrice);
                    $('#cartbox__item' + response.product.id).remove();

                    $('.cartbox__items').append(
                        "  <div class='cartbox__item' id = 'cartbox__item" + response.product.id +"'>" +
                        "      <div class='cartbox__item__thumb'>" +
                        "          <a href='/product/" + response.product.slug +"'>" +
                        "              <img src='http://"+ window.location.hostname +':'+ window.location.port + "/storage/uploads/cover_images/" + response.image +"' alt='"+ response.product.name +"'>" +
                        "          </a>" +
                        "      </div>" +
                        "      <div class='cartbox__item__content'>" +
                        "          <h5><a href='' class='product-name' > " + response.product.name + "</a></h5>" +
                        "              <p>Qty:<span>" + response.cart[id].quantity + "</span></p>" +
                        "                                <span class='price'> $" + response.cart[id].price  + " </span>" +
                        "      </div>" +
                        "<button class='cartbox__item__remove'>" +
                        "  <i class='delete-item fa fa-trash' id='" + response.product.id + "'></i>" +
                        "</button>" +
                        "  </div>");
                } else {
                    $('.cartbox-wrap').addClass('cartbox-wrap is-visible');
                    $('.input_quantity').val(0);
                    alert(Lang.get('en.cart.out_of'));
                }
            },
            error: function (err) {
                if(arguments[2] === 'Unauthorized'){
                    $('.accountbox-wrapper').addClass('accountbox-wrapper is-visible');
                }else{
                    alert(Lang.get('en.cart.error'));
                }
            }
        }
        e.preventDefault();
        $.ajax(options);
    } else {
        alert(Lang.get('en.cart.select_product'));
    }

});

var $rating = $('.rating-review li .fa');
var point;

var SetRatingStar = function() {
    return $rating.each(function() {
        if (parseInt($('.rating-value').val()) >= parseInt($(this).data('rating'))) {
            return $(this).removeClass('fa fa-star').addClass('fa fa-star rate');
        } else {
            return $(this).removeClass('fa fa-star rate').addClass('fa fa-star');
        }
    });
};

$rating.on('click', function() {
    $('.rating-value').val($(this).data('rating'));
    point =  $('.rating-value').val();
    return SetRatingStar();
});

$(document).on('click', '.review', function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var content = $('.review-text').val();
    var id = $(this).attr('id');
    var url = "/feedback/" + id + "/" + point;
    var options = {
        url:url,
        method:"post",
        data:{
            content:content,
            rating : point,
            id : id,
            _token: token,
        },
        success:function(response) {

            $('.single__review_user').remove();
            $('.review__wrapper').append(
                "<div class='single__review d-flex single__review_user'>" +
                "    <div class='review__details'>" +
                "        <h3>"+ response.user_name +"</h3>" +
                "        <div class='rev__meta d-flex justify-content-between'>" +
                "            <span>"+ response.feedback.created_at +"</span>" +
                "                <ul class='rating'>" +
                "                    <li><i class='fa fa-star rate' > x "+ point + "</i></li>" +
                "                </ul>" +
                "        </div>" +
                "        <p>" + content +"</p>" +
                "    </div>"+
                "</div>"
            )
        },
        error: function (err) {
            console.log(arguments);
        }
    }
    e.preventDefault();
    $.ajax(options);
});
